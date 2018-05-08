using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.IO;
using System.Xml;
using System.Diagnostics;

namespace Ulbotech_Decoder
{
    public partial class Form1 : Form
    {
        int DeviceIdLen = 15;
        int MinPacketLen = 22;
        const int ProtocolVersion = 1;
        const byte txtStartChar = (byte)'*';
        const byte txtEndChar = (byte)'#';
        const byte binFlagChar = 0xF8;
        const byte binEscapeChar = 0xF7;
        const byte AckFlag = 0xFE;
        FileStream tempFile = null;
        StreamWriter tempWrite = null;

        string[] eventInfo0 = {  "None",
                                "Interval upload",
                                "Angle change upload",
                                "Distance upload",

                                "Request upload"};

        string[] eventInfo1 = { "Rfid reader",
	                            "iBeacon"};
    

        public Form1()
        {
            InitializeComponent();
            string strXmlFile = System.AppDomain.CurrentDomain.SetupInformation.ApplicationBase + "initialize.xml";
            if (File.Exists(strXmlFile))
            {
                XmlDocument xmlDoc = new XmlDocument();
                xmlDoc.Load(strXmlFile);

                XmlNode node = xmlDoc.SelectSingleNode("Settings");
                DeviceIdLen = Convert.ToInt32(node.SelectSingleNode("dev_id_len").InnerText);
            }
            else
            {
                XmlTextWriter xmlWriter;

                xmlWriter = new XmlTextWriter(strXmlFile, Encoding.UTF8);//创建一个xml文档
                xmlWriter.Formatting = Formatting.Indented;
                xmlWriter.WriteStartDocument();

                xmlWriter.WriteStartElement("Settings");

                xmlWriter.WriteStartElement("dev_id_len");
                xmlWriter.WriteString("15");
                xmlWriter.WriteEndElement();

                xmlWriter.WriteEndElement();
                xmlWriter.Close();

                DeviceIdLen = 15;
            }
            if(DeviceIdLen != 15 && DeviceIdLen != 10)
            {
                DeviceIdLen = 15;
                MinPacketLen = DeviceIdLen + 7;
            }
        }

        private void btn_decode_Click(object sender, EventArgs e)
        {
            FileStream fs;
            progressBar1.Value = 0;
            if (openFileDialog.ShowDialog() == DialogResult.Cancel)
            {
                return;
            }
            try
            {
                fs = new FileStream(openFileDialog.FileName, FileMode.Open, FileAccess.Read);
            }
            catch (System.Exception ex)
            {
                MessageBox.Show(ex.Message);
                return;
            }
            byte[] readBuffer = new byte[(int)fs.Length];
            int dataLength = fs.Read(readBuffer, 0, (int)fs.Length);
            fs.Close();

            string path = System.AppDomain.CurrentDomain.BaseDirectory;
            path += "ulbodecode.tmp";
            try
            {
                tempFile = new FileStream(path, FileMode.OpenOrCreate, FileAccess.ReadWrite);
            }
            catch (System.Exception ex)
            {
                MessageBox.Show(ex.Message);
                return;
            }
            tempFile.SetLength(0);
            tempWrite = new StreamWriter(tempFile);


            DataDecode(readBuffer);

            tempWrite.Close();
            tempFile.Close();
            StreamReader tempReader;
            tempReader = new StreamReader(path);
            String str = tempReader.ReadToEnd();
            rtb_decode_info.AppendText(str);
            tempReader.Close();
            tempReader.Dispose();
            System.IO.FileInfo fi = new System.IO.FileInfo(@path);
            try
            {
                fi.Delete();
            }
            catch
            {
            }
            //MessageBox.Show("Decode finished");
        }

        private void btn_decode_txt_Click(object sender, EventArgs e)
        {
            progressBar1.Value = 0;
            if (txt_text.Text == "")
            {
                MessageBox.Show("Pls input text data!");
                return;
            }
            byte[] textData = System.Text.Encoding.Default.GetBytes(txt_text.Text);

            string path = System.AppDomain.CurrentDomain.BaseDirectory;
            path += "ulbodecode.tmp";
            try
            {
                tempFile = new FileStream(path, FileMode.OpenOrCreate, FileAccess.ReadWrite);
            }
            catch (System.Exception ex)
            {
                MessageBox.Show(ex.Message);
                return;
            }
            tempFile.SetLength(0);
            tempWrite = new StreamWriter(tempFile);

            byte[] ack = DataBinAcknowledgement(textData);
            string hexAck = "";
            for (int i = 0; i < ack.Length; i++)
            {
                hexAck += String.Format("{0:X2} ", ack[i]);
            }
            txt_ack_txt_binframe.Text = hexAck;

            txt_ack_txt_txtframe.Text = DataTxtAcknowledgement(textData);

            DataDecode(textData);

            tempWrite.Close();
            tempFile.Close();
            StreamReader tempReader;
            tempReader = new StreamReader(path);
            String str = tempReader.ReadToEnd();
            rtb_decode_info.AppendText(str);
            tempReader.Close();
            tempReader.Dispose();
            System.IO.FileInfo fi = new System.IO.FileInfo(@path);
            try
            {
                fi.Delete();
            }
            catch
            {
            }
            //MessageBox.Show("Decode finished");
        }

        private void btn_decode_bin_Click(object sender, EventArgs e)
        {
            progressBar1.Value = 0;
            if (txt_binary.Text == "")
            {
                MessageBox.Show("Pls input binary data!");
                return;
            }
            String strHex = txt_binary.Text;
            strHex = strHex.Replace(" ", "");
            strHex = strHex.Replace("\r", "");
            strHex = strHex.Replace("\n", "");
            strHex = strHex.Replace("\t", "");
            if (strHex.Length % 2 != 0)
            {
                MessageBox.Show("Data format error!");
                return;
            }
            strHex = strHex.ToUpper();
            for (int i = 0; i < strHex.Length; i++)
            {
                if (strHex[i] < '0' || strHex[i] > 'F' || (strHex[i] > '9' && strHex[i] < 'A'))
                {
                    MessageBox.Show("Data format error!");
                    return;
                }
            }
            byte[] binData = new byte[strHex.Length / 2];
            for (int i = 0; i < strHex.Length / 2; i++)
            {
                binData[i] = Convert.ToByte(strHex.Substring(2 * i, 2), 16);
            }

            string path = System.AppDomain.CurrentDomain.BaseDirectory;
            path += "ulbodecode.tmp";
            try
            {
                tempFile = new FileStream(path, FileMode.OpenOrCreate, FileAccess.ReadWrite);
            }
            catch (System.Exception ex)
            {
                MessageBox.Show(ex.Message);
                return;
            }
            tempFile.SetLength(0);
            tempWrite = new StreamWriter(tempFile);

            byte[] ack = DataBinAcknowledgement(binData);
            string hexAck = "";
            for (int i = 0; i < ack.Length; i++)
            {
                hexAck += String.Format("{0:X2} ", ack[i]);
            }
            txt_ack_bin_binframe.Text = hexAck;

            txt_ack_bin_txtframe.Text = DataTxtAcknowledgement(binData);

            DataDecode(binData);

            tempWrite.Close();
            tempFile.Close();
            StreamReader tempReader;
            tempReader = new StreamReader(path);
            String str = tempReader.ReadToEnd();
            rtb_decode_info.AppendText(str);
            tempReader.Close();
            tempReader.Dispose();
            System.IO.FileInfo fi = new System.IO.FileInfo(@path);
            try
            {
                fi.Delete();
            }
            catch
            {
            }
            //MessageBox.Show("Decode finished");
        }

        private void btn_save_Click(object sender, EventArgs e)
        {
            String fileName = "";
            if (saveFileDialog.ShowDialog() == DialogResult.Cancel)
            {
                return;
            }

            fileName = saveFileDialog.FileName;
            try
            {
                StreamWriter streamWriter = new StreamWriter(fileName);
                streamWriter.Write(rtb_decode_info.Text);
                streamWriter.Close();
            }
            catch (System.Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        void DataDecode(byte[] buffer)
        {
            if (buffer.Length == 0)
            {
                OutputText("Empty data!");
                return;
            }
            rtb_decode_info.Clear();
            OutputText("Starting decode...\r\n");
            int Offset = 0;
            while (Offset + MinPacketLen < buffer.Length)
            {
                progressBar1.Maximum = buffer.Length;
                progressBar1.Value = Offset;
                if (buffer[Offset] == txtStartChar)//Text frame start flag
                {
                    int endPos = Array.IndexOf(buffer, System.Convert.ToByte(txtEndChar), Offset + 1);//Get Text frame end flag position
                    if(endPos == -1 || (endPos - Offset) < 20|| !TextFrameFormatCheck(buffer, Offset, endPos))//Check Text frame format
                    {
                        Offset ++;
                        continue;
                    }

                    String strFrame = System.Text.Encoding.ASCII.GetString(buffer, Offset, endPos - Offset + 1);
                    TextFrameDecode(strFrame);
                    Offset = endPos + 1;
                }
                else if (buffer[Offset] == binFlagChar)//Binary packet flag
                {
                    int endPos = Array.IndexOf(buffer, System.Convert.ToByte(binFlagChar), Offset + 1);//Get binary frame end flag position
                    if (endPos == -1 || (endPos - Offset) < 12)
                    {
                        Offset++;
                        continue;
                    }

                    String strHexFrame = "";
                    for (int i = Offset; i < endPos + 1; i++)
                    {
                        strHexFrame += String.Format("{0:X2} ", buffer[i]);
                    }
                    OutputText(String.Format("BIN frame: {0}\r\n", strHexFrame));

                    byte[] binFrame = new byte[endPos - Offset - 1];
                    Array.Copy(buffer, Offset + 1, binFrame, 0, binFrame.Length);
                    int datalen = BinFrameFormatCheck(binFrame);
                    if (datalen <= 0)
                    {
                        OutputText("    CRC check error\r\n");
                        Offset++;
                        continue;
                    }
                    BinFrameDecode(binFrame, datalen);
                    Offset = endPos + 1;
                }
                else
                {
                    Offset++;
                }
            }
            progressBar1.Value = buffer.Length;
            OutputText("Decode finished!\r\n");
        }

        bool TextFrameFormatCheck(byte[] buffer, int first, int end)
        {
            String frameFirst = String.Format("*TS{0:d2},", ProtocolVersion);
            for(int i = 0; i < frameFirst.Length; i ++)
            {
                if(buffer[first + i] != frameFirst.ToCharArray()[i])
                    return false;
            }
            if(buffer[end] != txtEndChar)
                return false;
            for (int i = first + frameFirst.Length; i < end; i++)
            {
                if(buffer[i] < 0x20 || buffer[i] > 0x7F || buffer[i] == txtStartChar)
                    return false;
            }
            return true;
        }

        int BinFrameFormatCheck(byte[] binFrame)
        {
            bool bEscape = false;
            int len = 0;
            for (int i = 0; i < binFrame.Length; i++)
            {
                if (bEscape)
                {
                    bEscape = false;
                    binFrame[len++] = (byte)(binFrame[i] ^ binEscapeChar);
                }
                else
                {
                    if (binFrame[i] == binEscapeChar)
                    {
                        bEscape = true;
                        continue;
                    }
                    else
                    {
                        binFrame[len++] = binFrame[i];
                    }
                }
            }
            if (GetCrc16Value(binFrame, len) != 0)
                return 0;
            return len - 2;
        }

        DateTime GetDateTimeFromString(string str)
        {
            DateTime dt;
            try
            {
                dt = new DateTime(
                    System.Convert.ToInt16(str.Substring(10, 2)) + 2000,
                    System.Convert.ToInt16(str.Substring(8, 2)),
                    System.Convert.ToInt16(str.Substring(6, 2)),
                    System.Convert.ToInt16(str.Substring(0, 2)),
                    System.Convert.ToInt16(str.Substring(2, 2)),
                    System.Convert.ToInt16(str.Substring(4, 2)));
            }
            catch
            {
                dt = new DateTime(2000, 1, 1, 0, 0, 0);
            }
            return dt;
        }

        void TextFrameDecode(String str)
        {
            string TabChars = "    ";
            string[] infoKeyWords = { "GPS", "LBS", "STT", "MGR", "ADC", "GFS", "OBD", "OAL", "FUL", "HDB", "CAN", "HVD", "VIN", "RFI", "EVT", "BCN", "EGT", "TRP", "SAT", "BRV"};
            OutputText(String.Format("TXT frame: {0}\r\n", str));
            str = str.Substring(0, str.Length - 1);
            string[] info = str.Split(',');
            if (info.GetLength(0) < 4 || info[0] != String.Format("*TS{0:d2}", ProtocolVersion))
            {
                OutputText(String.Format("{0}Frame error!\r\n", TabChars));
                OutputText("\r\n");
                return;
            }

            OutputText(String.Format("{0}Device ID: {1}\r\n", TabChars, info[1]));

            if (info[2].Length != 12 || info[2] == "000000000000")
            {
                OutputText(String.Format("{0}Time stamp: {1}\r\n", TabChars, "Unknown"));
            }
            else
            {
                OutputText(String.Format("{0}Time stamp: {1}\r\n", TabChars, GetDateTimeFromString(info[2])));
            }

            for (int i = 3; i < info.GetLength(0); i++)
            {
                int keyIndex;
                int keyId = 0;
                string[] strFields = info[i].Split(':');
                if (strFields.GetLength(0) != 2 || strFields[1] == "")
                    continue;
                for(keyIndex = 0; keyIndex < infoKeyWords.GetLength(0); keyIndex ++)
                {
                    if (strFields[0].StartsWith(infoKeyWords[keyIndex]))
                    {
                        if(strFields[0].Length > 3)
                            keyId = Convert.ToUInt16(strFields[0].Substring(3));
                        break;
                    }
                }

                switch (keyIndex)
                {
                    case 0://GPS--GPS data
                        GpsDecodeFromString(strFields[1]);
                        break;
                    case 1://LBS--LBS data
                        LbsDecodeFromString(strFields[1]);
                        break;
                    case 2://STT--Device status data
                        SttDecodeFromString(strFields[1]);
                        break;
                    case 3://MGR--Mileage
                        MgrDecodeFromString(strFields[1]);
                        break;
                    case 4://ADC--Analog data
                        AdcDecodeFromString(strFields[1]);
                        break;
                    case 5://GFS--Geo-fence status
                        GfsDecodeFromString(strFields[1]);
                        break;
                    case 6://OBD--OBD data
                        ObdDecodeFromString(strFields[1]);
                        break;
                    case 7://OAL OBD alarm data
                        OalDecodeFromString(strFields[1]);
                        break;
                    case 8://FUL--Fuel used data
                        FulDecodeFromString(strFields[1], keyId);
                        break;
                    case 9://HDB--Driver behavior
                        HdbDecodeFromString(strFields[1]);
                        break;
                    case 10://CAN--J1939 data
                        CanDecodeFromString(strFields[1]);
                        break;
                    case 11://HVD--J1708 data
                        HvdDecodeFromString(strFields[1]);
                        break;
                    case 12://VIN--VIN data
                        VinDecodeFromString(strFields[1]);
                        break;
                    case 13://RFI--RFID data
                        RfiDecodeFromString(strFields[1]);
                        break;
                    case 14://EVT--Event code data
                        EvtDecodeFromString(strFields[1]);
                        break;
                    case 15://BCN--iBeacon info data
                        BcnDecodeFromString(strFields[1]);
                        break;
                    case 16://EGT--Engine seconds
                        EgtDecodeFromString(strFields[1]);
                        break;
                    case 17://TRP--Trip report
                        TrpDecodeFromString(strFields[1]);
                        break;
                    case 18://SAT--GPS Satellites Signal strength
                        SatDecodeFromString(strFields[1]);
                        break;
                    case 19://BRV--BLE Remote event
                        BrvDecodeFromString(strFields[1]);
                        break;
                    default:
                        CmdDecodeFromString(strFields[0], strFields[1]);
                        break;
                }
            }
            OutputText("\r\n");
        }

        void BinFrameDecode(byte[] dat, int len)
        {
            if (len < 10)
                return;
            int pos = 0;
            if (dat[pos] != ProtocolVersion)
            {
                OutputText(String.Format("    Can not support protocol version: {0:X2}\r\n", dat[pos]));
                return;
            }
            pos++;
            if (dat[pos] != 0x01)
            {
                OutputText(String.Format("    Can not support frame NO: {0:X2}\r\n", dat[pos]));
                return;
            }

            pos ++;
            String DeviceID = "";
            //for (int i = 0; i < 8; i++)
            for(int i = 0; i < (DeviceIdLen + 1)/2; i ++)
            {
                if (i == 0 && (DeviceIdLen & 0x01) != 0)
                    DeviceID += dat[pos++].ToString("X");
                else
                    DeviceID += dat[pos++].ToString("X2");
            }
            string TabChars = "    ";
            OutputText(String.Format("{0}Device ID: {1}\r\n", TabChars, DeviceID));

            UInt32 timeSeconds = ReadUint32(dat, pos);
            pos += 4; ;

            bool Fix3D = (timeSeconds & 0x80000000) != 0;
            timeSeconds &= 0x7FFFFFFF;
            if(timeSeconds == 0)
            {
                OutputText(String.Format("{0}Time stamp: {1}\r\n", TabChars, "Unknown"));
            }
            else
            {
                DateTime dtOffset = new DateTime(2000, 1, 1, 0, 0, 0);
                DateTime dt = new DateTime(dtOffset.Ticks + (long)timeSeconds * 10000000);
                OutputText(String.Format("{0}Time stamp: {1}\r\n", TabChars, dt));
            }
            while (pos < len - 2)
            {
                byte infoId = dat[pos++];
                int infoLen;
                switch (infoId)
                {
                    case 1://GPS
                        {
                            infoLen = dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            GpsDecodeFromBinary(infoData, Fix3D);
                            break;
                        }
                    case 2://LBS
                        {
                            infoLen = dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            LbsDecodeFromBinary(infoData);
                            break;
                        }
                    case 3://STT
                        {
                            infoLen = dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            SttDecodeFromBinary(infoData);
                            break;
                        }
                    case 4://MGR
                        {
                            infoLen = dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            MgrDecodeFromBinary(infoData);
                            break;
                        }
                    case 5://ADC
                        {
                            infoLen = dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            AdcDecodeFromBinary(infoData);
                            break;
                        }
                    case 6://GFS
                        {
                            infoLen = dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            GfsDecodeFromBinary(infoData);
                            break;
                        }
                    case 7://OBD
                        {
                            infoLen = dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            ObdDecodeFromBinary(infoData);
                            break;
                        }
                    case 8://FUL
                        {
                            infoLen = dat[pos++];
                            int algorithm = (infoLen >> 4) & 0x0f;
                            infoLen &= 0x0F;
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            FulDecodeFromBinary(infoData, algorithm);
                            break;
                        }
                    case 9://OAL
                        {
                            infoLen = dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            OalDecodeFromBinary(infoData);
                            break;
                        }
                    case 0x0A://HDB
                        {
                            infoLen = dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            HdbDecodeFromBinary(infoData);
                            break;
                        }
                    case 0x0B://CAN--J1939 data
                        {
                            infoLen = dat[pos++];
                            infoLen = infoLen * 256 + dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            CanDecodeFromBinary(infoData);
                            break;
                        }
                    case 0x0C://HVD--J1708 data
                        {
                            infoLen = dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            HvdDecodeFromBinary(infoData);
                            break;
                        }
                    case 0x0D://VIN
                        {
                            infoLen = dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            VinDecodeFromBinary(infoData);
                            break;
                        }
                    case 0x0E://RFI
                        {
                            infoLen = dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            RfiDecodeFromBinary(infoData);
                            break;
                        }
                    case 0x0F://EGT
                        {
                            infoLen = dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            EgtDecodeFromBinary(infoData);
                            break;
                        }
                    case 0x10://EVT
                        {
                            infoLen = dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            EvtDecodeFromBinary(infoData);
                            break;
                        }
                    case 0x20://TRP--Trip report
                        {
                            infoLen = dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            TrpDecodeFromBinary(infoData);
                            break;
                        }
                    case 0x21://SAT--GPS Satellites Signal strength
                        {
                            infoLen = dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            SatDecodeFromBinary(infoData);
                            break;
                        }
                    case 0x3F://BCN--iBeacon info data
                        {
                            infoLen = dat[pos++];
                            infoLen = infoLen * 256 + dat[pos++];
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            BcnDecodeFromBinary(infoData);
                            break;
                        }
                    case 0x3E://BRV--BLE remote event
                        {
                            infoLen = dat[pos] & 0x0F;
                            int ble_evt = dat[pos++] >> 4;
                            byte[] infoData = new byte[infoLen];
                            Array.Copy(dat, pos, infoData, 0, infoLen);
                            BrvDecodeFromBinary(infoData, ble_evt);
                            break;
                        }
                    default:
                        infoLen = dat[pos++];
                        break;
                }
                pos += infoLen;
            }
        }

        void GpsDecodeFromString(string str)
        {
            string TabChars = "    ";
            string[] gps = str.Split(';');
            if(gps.GetLength(0) != 6)
                return;
            OutputText(TabChars + "GPS:" + "\r\n");
            TabChars = TabChars + TabChars ;

            OutputText(String.Format("{0}Status: {1}\r\n", TabChars, (gps[0] == "3" ? "3D" : (gps[0] == "2" ? "2D" : "No fixed"))));
            OutputText(String.Format("{0}Latitude: {1}{2}\r\n", TabChars, (gps[1].Substring(0, 1) == "S" ? "-" : ""), gps[1].Substring(1)));
            OutputText(String.Format("{0}Longitude: {1}{2}\r\n", TabChars, (gps[2].Substring(0, 1) == "W" ? "-" : ""), gps[2].Substring(1)));
            OutputText(String.Format("{0}Speed: {1}\r\n", TabChars, gps[3]));
            OutputText(String.Format("{0}Course: {1}\r\n", TabChars, gps[4]));
            OutputText(String.Format("{0}HDOP: {1}\r\n", TabChars, gps[5]));
        }

        void GpsDecodeFromBinary(byte[] info, bool b3d)
        {
            if (info.Length != 14)
                return;

            string TabChars = "    ";
            OutputText(TabChars + "GPS:" + "\r\n");
            TabChars = TabChars + TabChars;
            string gpsfixed;
            if (ReadInt32(info, 0) == 0 && ReadInt32(info, 4) == 0)//Latitude and Longitude all zero
                gpsfixed = "NoFix";
            else
                gpsfixed = b3d ? "3D" : "2D";

            OutputText(String.Format("{0}Status: {1}\r\n", TabChars, gpsfixed));
            OutputText(String.Format("{0}Latitude: {1:0.000000}\r\n", TabChars, (double)ReadInt32(info, 0)/1000000));
            OutputText(String.Format("{0}Longitude: {1:0.000000}\r\n", TabChars, (double)ReadInt32(info, 4)/1000000));
            OutputText(String.Format("{0}Speed: {1}\r\n", TabChars, ReadUint16(info, 8)));
            OutputText(String.Format("{0}Course: {1}\r\n", TabChars, ReadUint16(info, 10)));
            OutputText(String.Format("{0}HDOP: {1:0.00}\r\n", TabChars, (double)ReadUint16(info, 12)/100));
        }
        
        void LbsDecodeFromString(string str)
        {
            string TabChars = "    ";
            string[] lbs = str.Split(';');
            if (lbs.GetLength(0) < 5)
                return;
            OutputText(TabChars + "LBS:" + "\r\n");
            TabChars = TabChars + TabChars;

            OutputText(String.Format("{0}MCC: {1}(dec), MNC: {2}(dec)\r\n", TabChars, lbs[0], lbs[1]));
            int stations = (lbs.GetLength(0) - 2) / 3;
            for (int i = 0; i < stations && i < 7; i++)
            {
                OutputText(String.Format("{0}Cell{1}: LAC: {2}(hex), CID: {3}(hex), dbm: -{4}\r\n",
                    TabChars,
                    i,
                    lbs[2 + i * 3],
                    lbs[2 + i * 3 + 1],
                    lbs[2 + i * 3 + 2]));
            }
        }

        void LbsDecodeFromBinary(byte[] info)
        {
            string TabChars = "    ";
            if (info.Length < 9)
                return;

            OutputText(TabChars + "LBS:" + "\r\n");
            TabChars = TabChars + TabChars;

            if (info.Length == 0x0B)
            {
                OutputText(String.Format("{0}MCC: {1}(dec), MNC: {2}(dec)\r\n", TabChars, ReadUint16(info, 0), ReadUint16(info, 2)));
                OutputText(String.Format("{0}Cell: LAC: {1:X4}(hex), CID: {2:X6}(hex), dbm: -{3}\r\n",
                        TabChars,
                        ReadUint16(info, 4),
                        ReadUint32(info, 6),
                        ReadUnsignedByte(info, 10)));
            }
            else
            {
                if ((info.Length - 4) % 5 != 0)
                    return;
                if ((info.Length - 4) / 5 > 7)
                    return;

                OutputText(String.Format("{0}MCC: {1}(dec), MNC: {2}(dec)\r\n", TabChars, ReadUint16(info, 0), ReadUint16(info, 2)));
                for (int i = 0; i < (info.Length - 4) / 5; i++)
                {
                    OutputText(String.Format("{0}Cell{1}: LAC: {2:X4}(hex), CID: {3:X4}(hex), dbm: -{4}\r\n",
                        TabChars,
                        i,
                        ReadUint16(info, 4 + i * 5),
                        ReadUint16(info, 4 + i * 5 + 2),
                        ReadUnsignedByte(info, 4 + i * 5 + 4)));
                }
            }
        }

        void SttDecodeFromString(string str)
        {
            string TabChars = "    ";
            string[] stt = str.Split(';');
            if (stt.GetLength(0) != 2)
                return;
            OutputText(TabChars + "STT:" + "\r\n");
            TabChars = TabChars + TabChars;
            UInt16 iStatus = UInt16.Parse(stt[0], System.Globalization.NumberStyles.HexNumber);
            UInt16 iAlarm = UInt16.Parse(stt[1], System.Globalization.NumberStyles.HexNumber);
            String[] infoStatus = {"Power cut", 
                                  "Moving", 
                                  "Over speed", 
                                  "Jamming", 
                                  "Geo-fence alarming",
                                  "Immobolizer",
                                  "ACC",
                                  "Input high level",
                                  "Input mid level",
                                  "Engine",
                                  "Panic",
                                  "OBD alarm",
                                  "Course rapid change",
                                  "Speed rapid change",
                                  "Roaming(T3xx)/BLE connecting(L10x)",
                                  "Inter roaming(T3xx)/OBD connecting(L10x)"};
            String[] infoAlarm = {"Power cut",
                                 "Moved",
                                 "Over speed",
                                 "Jamming",
                                 "Geo-fence",
                                 "Towing",
                                 "Reserved",
                                 "Input low",
                                 "Input high",
                                 "Reserved",
                                 "Panic",
                                 "OBD",
                                 "Reserved",
                                 "Reserved",
                                 "Accident",
                                 "Battery low"};
            OutputText(TabChars + "Status:" + "\r\n");
            for (int i = 0; i < 16; i++)
            {
                UInt16 bitMask = (UInt16)(0x0001 << i);
                String strStatus = String.Format("            [Bit{0:D2}]:{1}--{2}\r\n",
                                                 i,
                                                 (iStatus & bitMask) != 0 ? 1 : 0,
                                                 infoStatus[i]);
                OutputText(strStatus);
            }
            OutputText(TabChars + "Alarm:" + "\r\n");
            for (int i = 0; i < 16; i++)
            {
                UInt16 bitMask = (UInt16)(0x0001 << i);
                String strAlarm = String.Format("            [Bit{0:D2}]:{1}--{2}\r\n",
                                                 i,
                                                 (iAlarm & bitMask) != 0 ? 1 : 0,
                                                 infoAlarm[i]);
                OutputText(strAlarm);
            }
        }

        void SttDecodeFromBinary(byte[] info)
        {
            string TabChars = "    ";
            if (info.Length != 4)
                return;
            OutputText(TabChars + "STT:" + "\r\n");
            TabChars = TabChars + TabChars;
            UInt16 iStatus = ReadUint16(info, 0);
            UInt16 iAlarm = ReadUint16(info, 2);
            String[] infoStatus = {"Power cut", 
                                  "Moving", 
                                  "Over speed", 
                                  "Jamming", 
                                  "Geo-fence alarming",
                                  "Immobolizer",
                                  "ACC",
                                  "Input high level",
                                  "Input mid level",
                                  "Engine",
                                  "Panic",
                                  "OBD alarm",
                                  "Course rapid change",
                                  "Speed rapid change",
                                  "Roaming(T3xx)/BLE connecting(L10x)",
                                  "Inter roaming(T3xx)/OBD connecting(L10x)"};
            String[] infoAlarm = {"Power cut",
                                 "Moved",
                                 "Over speed",
                                 "Jamming",
                                 "Geo-fence",
                                 "Towing",
                                 "Reserved",
                                 "Input low",
                                 "Input high",
                                 "Reserved",
                                 "Panic",
                                 "OBD",
                                 "Reserved",
                                 "Reserved",
                                 "Accident",
                                 "Battery low"};
            OutputText(TabChars + "Status:" + "\r\n");
            for (int i = 0; i < 16; i++)
            {
                UInt16 bitMask = (UInt16)(0x0001 << i);
                String strStatus = String.Format("            [Bit{0:D2}]:{1}--{2}\r\n",
                                                 i,
                                                 (iStatus & bitMask) != 0 ? 1 : 0,
                                                 infoStatus[i]);
                OutputText(strStatus);
            }
            OutputText(TabChars + "Alarm:" + "\r\n");
            for (int i = 0; i < 16; i++)
            {
                UInt16 bitMask = (UInt16)(0x0001 << i);
                String strAlarm = String.Format("            [Bit{0:D2}]:{1}--{2}\r\n",
                                                 i,
                                                 (iAlarm & bitMask) != 0 ? 1 : 0,
                                                 infoAlarm[i]);
                OutputText(strAlarm);
            }
        }

        void MgrDecodeFromString(string str)
        {
            OutputText(String.Format("    Mileage: {0}(meters)\r\n", str));
        }

        void MgrDecodeFromBinary(byte[] info)
        {
            if (info.Length != 4)
                return;
            OutputText(String.Format("    Mileage: {0}(meters)\r\n", ReadUint32(info, 0)));
        }

        void AdcDecodeFromString(string str)
        {
            string TabChars = "    ";
            string[] adc = str.Split(';');
            if (adc.GetLength(0)%2 != 0)
                return;
            OutputText(TabChars + "Analog value:" + "\r\n");
            TabChars = TabChars + TabChars;

            String[] infoAdc = {"Car Battery",
                                "Device Temp.",
                                "Inner Battery",
                                "Input voltage"};
            String[] infoUnit = { "(V)", "(Celsius)", "(V)", "(V)" };
            for (int i = 0; i < adc.GetLength(0) / 2; i++)
            {
                if (i.ToString() == adc[2 * i])
                {
                    String strAdc = String.Format("{0}{1}: {2}{3}--{4}\r\n",
                                                 TabChars,
                                                 i,
                                                 adc[2*i + 1],
                                                 infoUnit[i],
                                                 i < infoAdc.GetLength(0)? infoAdc[i] : "Unknow");
                    OutputText(strAdc);
                }
            }
        }

        void AdcDecodeFromBinary(byte[] info)
        {
            if (info.Length % 2 != 0)
            if (info.Length > 32)
                return;

            string TabChars = "    ";
            OutputText(TabChars + "Analog value:" + "\r\n");
            TabChars = TabChars + TabChars;

            String[] infoAdc = {"Car Battery",
                                "Device Temp.",
                                "Inner Battery",
                                "Input voltage"};
            String[] infoUnit = { "(V)", "(Celsius)", "(V)", "(V)" };
            for (int i = 0; i < info.Length / 2; i++)
            {
                UInt16 val = ReadUint16(info, 2 * i);
                byte valId = (byte)((val >> 12) & 0x000f);
                val &= 0x0fff;
                String strAdc;
                switch (valId)
                {
                    case 0:
                    case 2:
                    case 3:
                        strAdc = String.Format("{0}{1}: {2:0.00}{3}--{4}\r\n",
                                                 TabChars,
                                                 valId,
                                                 (double)val * (100 - (-10))/4096 + (-10),
                                                 "(V)",
                                                 infoAdc[i]);
                        break;
                    case 1:
                        strAdc = String.Format("{0}{1}: {2:0.00}{3}--{4}\r\n",
                                                 TabChars,
                                                 valId,
                                                 (double)val * (125 - (-55)) / 4096 + (-55),
                                                 "(Celsius)",
                                                 infoAdc[i]);
                        break;
                    default:
                        strAdc = String.Format("{0}{1}: {2}--Unknow\r\n",
                                                 TabChars,
                                                 valId,
                                                 val);
                        break;
                }
                OutputText(strAdc);
            }
        }

        void GfsDecodeFromString(string str)
        {
            string TabChars = "    ";
            string[] gfs = str.Split(';');
            if (gfs.GetLength(0) != 2)
                return;
            OutputText(TabChars + "Geo-fence:" + "\r\n");
            TabChars = TabChars + TabChars;
            UInt32 iStatus = UInt32.Parse(gfs[0], System.Globalization.NumberStyles.HexNumber);
            UInt32 iAlarm = UInt32.Parse(gfs[1], System.Globalization.NumberStyles.HexNumber);
            OutputText(TabChars + "Status:\r\n");
            OutputText("            ");
            for (int i = 0; i < 16; i++)
            {
                UInt32 bitMask = (UInt32)(0x0001 << i);
                String strStatus = String.Format("{0:D2}:{1}, ",
                                                 i,
                                                 (iStatus & bitMask) != 0 ? "I" : "O");
                OutputText(strStatus);
            }
            OutputText("\r\n");
            OutputText("            ");
            for (int i = 16; i < 32; i++)
            {
                UInt32 bitMask = (UInt32)(0x0001 << i);
                String strStatus = String.Format("{0:D2}:{1}, ",
                                                 i,
                                                 (iStatus & bitMask) != 0 ? "I" : "O");
                OutputText(strStatus);
            }
            OutputText("\r\n");

            OutputText(TabChars + "Alarm:\r\n");
            OutputText("            ");
            for (int i = 0; i < 16; i++)
            {
                UInt32 bitMask = (UInt32)(0x0001 << i);
                String strAlarm = String.Format("{0:D2}:{1}, ",
                                                 i,
                                                 (iAlarm & bitMask) != 0 ? "Y" : "N");
                OutputText(strAlarm);
            }
            OutputText("\r\n");
            OutputText("            ");
            for (int i = 16; i < 32; i++)
            {
                UInt32 bitMask = (UInt32)(0x0001 << i);
                String strAlarm = String.Format("{0:D2}:{1}, ",
                                                 i,
                                                 (iAlarm & bitMask) != 0 ? "Y" : "N");
                OutputText(strAlarm);
            }
            OutputText("\r\n");
        }

        void GfsDecodeFromBinary(byte[] info)
        {
            string TabChars = "    ";
            if (info.Length != 8)
                return;
            OutputText(TabChars + "Geo-fence:" + "\r\n");
            TabChars = TabChars + TabChars;
            UInt32 iStatus = ReadUint32(info, 0);
            UInt32 iAlarm = ReadUint32(info, 4);
            OutputText(TabChars + "Status:\r\n");
            OutputText("            ");
            for (int i = 0; i < 16; i++)
            {
                UInt32 bitMask = (UInt32)(0x0001 << i);
                String strStatus = String.Format("{0:D2}:{1}, ",
                                                 i,
                                                 (iStatus & bitMask) != 0 ? "I" : "O");
                OutputText(strStatus);
            }
            OutputText("\r\n");
            OutputText("            ");
            for (int i = 16; i < 32; i++)
            {
                UInt32 bitMask = (UInt32)(0x0001 << i);
                String strStatus = String.Format("{0:D2}:{1}, ",
                                                 i,
                                                 (iStatus & bitMask) != 0 ? "I" : "O");
                OutputText(strStatus);
            }
            OutputText("\r\n");

            OutputText(TabChars + "Alarm:\r\n");
            OutputText("            ");
            for (int i = 0; i < 16; i++)
            {
                UInt32 bitMask = (UInt32)(0x0001 << i);
                String strAlarm = String.Format("{0:D2}:{1}, ",
                                                 i,
                                                 (iAlarm & bitMask) != 0 ? "Y" : "N");
                OutputText(strAlarm);
            }
            OutputText("\r\n");
            OutputText("            ");
            for (int i = 16; i < 32; i++)
            {
                UInt32 bitMask = (UInt32)(0x0001 << i);
                String strAlarm = String.Format("{0:D2}:{1}, ",
                                                 i,
                                                 (iAlarm & bitMask) != 0 ? "Y" : "N");
                OutputText(strAlarm);
            }
            OutputText("\r\n");
        }

        void ObdDecodeFromString(string str)
        {
            if (str.Length % 2 != 0)
                return;
            OutputText("    " + "OBDII:" + "\r\n");

            byte[] obddata = new byte[str.Length / 2];

            for (int i = 0; i < str.Length / 2; i++)
            {
                obddata[i] = System.Convert.ToByte(str.Substring(2 * i, 2), 16);
            }
            ObdDataDecode(obddata);
        }

        void ObdDecodeFromBinary(byte[] info)
        {
            OutputText("    " + "OBDII:" + "\r\n");
            ObdDataDecode(info);
        }

        void OalDecodeFromString(string str)
        {
            if (str.Length % 2 != 0)
                return;
            OutputText("    " + "OBDII Alarm:" + "\r\n");

            byte[] obdalarm = new byte[str.Length / 2];

            for (int i = 0; i < str.Length / 2; i++)
            {
                obdalarm[i] = System.Convert.ToByte(str.Substring(2 * i, 2), 16);
            }
            ObdDataDecode(obdalarm);
        }

        void OalDecodeFromBinary(byte[] info)
        {
            OutputText("    " + "OBDII Alarm:" + "\r\n");
            ObdDataDecode(info);
        }

        void ObdDataDecode(byte[] obddata)
        {
            int pos = 0;
            while (pos < obddata.Length)
            {
                int len = (int)((obddata[pos] >> 4) & 0x0F);
                if (len + pos > obddata.Length)
                    break;
                if (len < 3 || len > 8)
                {
                    pos += len;
                    continue;
                }
                int service = (int)(obddata[pos] & 0x0f);
                switch (service)
                {
                    case 1://Mode 01
                    case 2://Mode 02
                        {
                            int pid = obddata[pos + 1];
                            byte[] pidValue = new byte[len - 2];
                            Array.Copy(obddata, pos + 2, pidValue, 0, pidValue.Length);
                            ObdService0102Decode(pidValue, service, pid);
                            break;
                        }
                    case 3://Mode 03
                        {
                            byte[] Value = new byte[len - 1];
                            Array.Copy(obddata, pos + 1, Value, 0, Value.Length);
                            ObdService03Decode(Value);
                            break;
                        }
                    case 4://Mode 04
                        break;
                    case 5://Mode 05
                        break;
                    case 6://Mode 06
                        break;
                    case 7://Mode 07
                        break;
                    case 8://Mode 08
                        break;
                    case 9://Mode 09
                        break;
                    case 10://Mode 0A
                        break;
                    case 11://mode 21  Read Data By Identifier
                        {
                            byte[] Value = new byte[len - 1];
                            Array.Copy(obddata, pos + 1, Value, 0, Value.Length);
                            ObdService21Decode(Value);
                            break;
                        }
                    case 12://mode 22  Read Data By Identifier
                        /*{
                            byte[] Value = new byte[len - 1];
                            Array.Copy(obddata, pos + 1, Value, 0, Value.Length);
                            ObdService22Decode(Value);
                            break;
                        }*/
                        {
                            UInt16 pid = ReadUint16(obddata, pos + 1);
                            byte[] pidValue = new byte[len - 3];
                            Array.Copy(obddata, pos + 3, pidValue, 0, pidValue.Length);
                            UdsService22Decode(pidValue, pid);
                            break;
                        }
                    case 15://CANBUS sniffer data
                        {
                            byte[] Value = new byte[len - 1];
                            Array.Copy(obddata, pos + 1, Value, 0, Value.Length);
                            ObdCanSnifferDecode(Value);
                            break;
                        }
                    default:
                        break;
                }
                pos += len;
            }
        }

        void FulDecodeFromString(string str, int id)
        {
            String strFul = String.Format("    Fuel consumption: Algorithm[{0}]{1}\r\n", 
                                  id,
                                  str);
            OutputText(strFul);
        }

        void FulDecodeFromBinary(byte[] info, int id)
        {
            if (info.Length != 4)
                return;
            UInt32 fuel = ReadUint32(info, 0);

            String strFul = String.Format("    Fuel consumption: Algorithm[{0}]{1}\r\n",
                                  id,
                                  fuel);
            OutputText(strFul);
        }

        void HdbDecodeFromString(string str)
        {
            byte hdb = System.Convert.ToByte(str, 16);
            if (hdb == 0)
                return;
            OutputText("    " + "Driver Behavior:" + "\r\n");
            String[] infoBehavior = {"Rapid acceleration",
                                     "Rough braking",
                                     "Harsh course",
                                     "No warmup",
                                     "Long idle",
                                     "Fatigue driving",
                                     "Rough terrain",
                                     "High RPM"};
            for (int i = 0; i < 8; i++)
            {
                UInt16 bitMask = (UInt16)(0x0001 << i);
                if((hdb & bitMask) == 0)
                    continue;
                String strHdb = String.Format("            [Bit{0}]--{1}\r\n",
                                                 i,
                                                 infoBehavior[i]);
                OutputText(strHdb);
            }
        }

        void HdbDecodeFromBinary(byte[] info)
        {
            if (info.Length != 1)
                return;

            byte hdb = ReadUnsignedByte(info, 0);
            if (hdb == 0)
                return;
            OutputText("    " + "Driver Behavior:" + "\r\n");
            String[] infoBehavior = {"Rapid acceleration",
                                     "Rough braking",
                                     "Harsh course",
                                     "No warmup",
                                     "Long idle",
                                     "Fatigue driving",
                                     "Rough terrain",
                                     "High RPM"};
            for (int i = 0; i < 8; i++)
            {
                UInt16 bitMask = (UInt16)(0x0001 << i);
                if ((hdb & bitMask) == 0)
                    continue;
                String strHdb = String.Format("            [Bit{0}]--{1}\r\n",
                                                 i,
                                                 infoBehavior[i]);
                OutputText(strHdb);
            }
        }

        void CanDecodeFromString(string str)
        {
            if (str.Length % 2 != 0)
                return;
            OutputText("    " + "J1939:" + "\r\n");

            byte[] j1939data = new byte[str.Length / 2];

            for (int i = 0; i < str.Length / 2; i++)
            {
                j1939data[i] = System.Convert.ToByte(str.Substring(2 * i, 2), 16);
            }
            J1939DataDecode(j1939data);
        }

        void CanDecodeFromBinary(byte[] info)
        {
            OutputText("    " + "J1939:" + "\r\n");
            J1939DataDecode(info);
        }

        void J1939DataDecode(byte[] candata)
        {
            int pos = 0;
            while (pos < candata.Length)
            {
                int len = candata[pos];
                if (len + pos + 1 > candata.Length)
                    break;
                if (len < 4 || candata[pos + 1] != 0)
                {
                    pos += len + 1;
                    continue;
                }

                int pgn = ReadUint16(candata, pos + 2);
                byte[] value = new byte[len - 3];
                Array.Copy(candata, pos + 4, value, 0, value.Length);
                J1939PgnDecode(value, pgn);
                pos += len + 1;
            }
        }

        void HvdDecodeFromString(string str)
        {
            if (str.Length % 2 != 0)
                return;
            OutputText("    " + "J1708:" + "\r\n");

            byte[] j1708data = new byte[str.Length / 2];

            for (int i = 0; i < str.Length / 2; i++)
            {
                j1708data[i] = System.Convert.ToByte(str.Substring(2 * i, 2), 16);
            }
            J1708DataDecode(j1708data);
        }

        void HvdDecodeFromBinary(byte[] info)
        {
            OutputText("    " + "J1708:" + "\r\n");
            J1708DataDecode(info);
        }

        void J1708DataDecode(byte[] hvddata)
        {
            int pos = 0;
            while (pos < hvddata.Length)
            {
                int len = (int)(hvddata[pos] & 0x3F);
                int paratype = (int)((hvddata[pos] >> 6) & 0x03);
                if (len + pos > hvddata.Length)
                    break;
                if (len < 2 || len > 22 || paratype == 0)
                {
                    pos += len + 1;
                    continue;
                }
                if (paratype == 1)//MID data
                {
                    byte[] Value = new byte[len];
                    Array.Copy(hvddata, pos + 1, Value, 0, Value.Length);
                    J1708MidDecode(Value);
                }
                else
                {
                    int j1587pid = hvddata[pos + 1];
                    if (paratype == 3)
                    {
                        j1587pid += 256;
                    }
                    byte[] Value = new byte[len - 1];
                    Array.Copy(hvddata, pos + 2, Value, 0, Value.Length);
                    J1587PidDecode(Value, j1587pid);
                }
                pos += len + 1;
            }
        }

        void VinDecodeFromString(string str)
        {
            String strVin = String.Format("    VIN: {0}\r\n",
                                  str);
            OutputText(strVin);
        }

        void VinDecodeFromBinary(byte[] info)
        {
            String strVin = String.Format("    VIN: {0}\r\n",
                                  System.Text.Encoding.Default.GetString( info ));
            OutputText(strVin);
        }

        void RfiDecodeFromString(string str)
        {
            string[] paras = str.Split(';');
            String strRfid = String.Format("    RFID: {0}({1})\r\n",
                paras[0], paras[1] == "0" ? "Unauthorized" : "Authorized");
            OutputText(strRfid);
        }

        void RfiDecodeFromBinary(byte[] info)
        {
            if (info.GetLength(0) != 11)
                return;
            String strRfid = String.Format("    RFID: {0}({1})\r\n",
                                  System.Text.Encoding.Default.GetString(info, 0, 10), info[10] == 0 ? "Unauthorized" : "Authorized");
            OutputText(strRfid);
        }

        void EvtDecodeFromString(string str)
        {
            string[] paras = str.Split(';');
            if (paras[0].Length > 2)
                return;
            if (paras.GetLength(0) == 2 && paras[1].Length > 8)
                return;
            Byte eventCode = System.Convert.ToByte(paras[0], 16);
            UInt32 mask = 0;
            if (paras.GetLength(0) == 2)
            {
                mask = System.Convert.ToUInt32(paras[1], 16);
            }
            EvtCodeStringOut(eventCode, mask);
        }

        void EvtDecodeFromBinary(byte[] info)
        {
            if (info.GetLength(0) != 1 && info.GetLength(0) != 5)
                return;
            Byte eventCode = info[0];
            UInt32 mask = 0;
            if (info.GetLength(0) == 5)
            {
                mask = ReadUint32(info, 1);
            }

            EvtCodeStringOut(eventCode, mask);
        }

        void EvtCodeStringOut(byte evt, UInt32 mask)
        {
            string eventInfo = "";
            if (evt < 0x10)
            {
                if (evt < eventInfo0.GetLength(0))
                {
                    eventInfo = eventInfo0[evt];
                }
            }
            else if (evt < 0x80)
            {
                evt -= 0x10;
                if (evt < eventInfo1.GetLength(0))
                {
                    eventInfo = eventInfo1[evt];
                }
            }
            else if (evt == 0x80)
            {
                string strEvent = "";
                UInt32 msk = 1;
                for (int i = 0; i < 32; i++)
                {
                    if ((mask & msk) != 0)
                    {
                        strEvent += (i + i).ToString() + "|";
                    }
                    msk <<= 1;
                }
                strEvent = strEvent.Remove(strEvent.Length - 1);
                eventInfo = String.Format("GeoFence status changed: ({0})",
                                  strEvent);
            }
            else if (evt == 0x90)
            {
                String[] infoBehavior = {"Rapid acceleration",
                                     "Rough braking",
                                     "Harsh course",
                                     "No warmup",
                                     "Long idle",
                                     "Fatigue driving",
                                     "Rough terrain",
                                     "High RPM"};
                string strEvent = "";
                UInt32 msk = 1;
                for (int i = 0; i < 8; i++)
                {
                    if ((mask & msk) != 0)
                    {
                        strEvent += infoBehavior[i] + "|";
                    }
                    msk <<= 1;
                }
                strEvent = strEvent.Remove(strEvent.Length - 1);
                eventInfo = String.Format("Hash driving detected: ({0})",
                                  strEvent);
            }
            else if (evt == 0xE0 || evt == 0xF8)
            {
                String[] infoAlarm = {"Power cut",
                                 "Moved",
                                 "Over speed",
                                 "Jamming",
                                 "Geo-fence",
                                 "Towing",
                                 "Reserved",
                                 "Input low",
                                 "Input high",
                                 "Reserved",
                                 "Panic",
                                 "OBD",
                                 "Reserved",
                                 "Reserved",
                                 "Accident",
                                 "Battery low"};
                string strEvent = "";
                UInt32 msk = 1;
                for (int i = 0; i < 16; i++)
                {
                    if ((mask & msk) != 0)
                    {
                        strEvent += infoAlarm[i] + "|";
                    }
                    msk <<= 1;
                }
                strEvent = strEvent.Remove(strEvent.Length - 1);
                eventInfo = String.Format("Alarm trigged:({0})",
                                  strEvent);
            }
            else if (evt == 0xF0)
            {
                String[] infoStatus = {"Power cut", 
                                  "Moving", 
                                  "Over speed", 
                                  "Jamming", 
                                  "Geo-fence alarming",
                                  "Immobolizer",
                                  "ACC",
                                  "Input high level",
                                  "Input mid level",
                                  "Engine",
                                  "Panic",
                                  "OBD alarm",
                                  "Course rapid change",
                                  "Speed rapid change",
                                  "Roaming",
                                  "Inter roaming"};
                string strEvent = "";
                UInt32 msk = 1;
                for (int i = 0; i < 16; i++)
                {
                    if ((mask & msk) != 0)
                    {
                        strEvent += infoStatus[i] + "|";
                    }
                    msk <<= 1;
                }
                if(strEvent != "")
                    strEvent = strEvent.Remove(strEvent.Length - 1);
                eventInfo = String.Format("Device status changed:({0})",
                                  strEvent);
            }
            if(eventInfo == "")
            {
                eventInfo = "Unknown";
            }
            String strEventCode = String.Format("    Event code: {0}\r\n",
                                  eventInfo);
            OutputText(strEventCode);
        }

        void BcnDecodeFromString(string str)
        {
            string[] paras = str.Split(';');
            if (paras.GetLength(0) < 2)
                return;
            int i = 0;
            while (i < paras.GetLength(0))
            {
                if (paras[i] == "1")
                {
                    for (i = i + 1; i < paras.GetLength(0); i++)
                    {
                        if (paras[i].Length != 44)
                            break;
                        String strBeacon = String.Format("    iBeacon found UUID:0x{0} Major:0x{1} Minor:0x{2} Power:0x{3} RSSI:-{4}dbm\r\n",
                                                         paras[i].Substring(0, 32),
                                                         paras[i].Substring(32, 4),
                                                         paras[i].Substring(36, 4),
                                                         paras[i].Substring(40, 2),
                                                         System.Convert.ToByte(paras[i].Substring(42, 2), 16).ToString());
                        OutputText(strBeacon);
                    }
                }
                else if (paras[i] == "0")
                {
                    for (i = i + 1; i < paras.GetLength(0); i++)
                    {
                        if (paras[i].Length != 40)
                            break;
                        String strBeacon = String.Format("    iBeacon lost UUID:0x{0} Major:0x{1} Minor:0x{2}\r\n",
                                                         paras[i].Substring(0, 32),
                                                         paras[i].Substring(32, 4),
                                                         paras[i].Substring(36, 4));
                        OutputText(strBeacon);
                    }
                }
                else
                {
                    return;
                }
            }
        }

        void BcnDecodeFromBinary(byte[] info)
        {
            int i = 0;
            while (i < info.GetLength(0))
            {
                if ((info[i] & 0x80) == 0)//iBeacon lost
                {
                    byte count = (byte)(info[i ++] & 0x7F);
                    if (info.GetLength(0) < (count * 20 + i))
                        return;
                    
                    int cnt = 0;
                    while (cnt < count)
                    {
                        string strUUID = "";
                        for (int j = 0; j < 16; j++)
                        {
                            strUUID += String.Format("{0:X2}", info[i ++]);
                        }
                        UInt16 major = ReadUint16(info, i);
                        i += 2;
                        UInt16 minor = ReadUint16(info, i);
                        i += 2;
                        String strBeacon = String.Format("    iBeacon lost UUID:0x{0} Major:0x{1:X0000} Minor:0x{2:X0000}\r\n",
                                                             strUUID,
                                                             major,
                                                             minor);
                        OutputText(strBeacon);
                        cnt++;
                    }
                }
                else                //iBeacon found
                {
                    byte count = (byte)(info[i++] & 0x7F);
                    if (info.GetLength(0) < (count * 22 + i))
                        return;
                    int cnt = 0;
                    while (cnt < count)
                    {
                        string strUUID = "";
                        for (int j = 0; j < 16; j++)
                        {
                            strUUID += String.Format("{0:X2}", info[i ++]);
                        }
                        UInt16 major = ReadUint16(info, i);
                        i += 2;
                        UInt16 minor = ReadUint16(info, i);
                        i += 2;
                        Byte power = info[i ++];
                        Byte rssi = info[i ++];
                        String strBeacon = String.Format("    iBeacon found UUID:0x{0} Major:0x{1:X0000} Minor:0x{2:X0000} Power:0x{3:X0000} RSSI:-{4}dbm\r\n",
                                                             strUUID,
                                                             major,
                                                             minor,
                                                             power,
                                                             rssi);
                        OutputText(strBeacon);
                        cnt++;
                    }
                }
            }
        }

        void TrpDecodeFromString(string str)
        {
            string TabChars = "    ";
            string[] trip = str.Split(';');
            if (trip.GetLength(0) != 14)
                return;
            OutputText(TabChars + "Trip report:" + "\r\n");
            TabChars = TabChars + TabChars;

            DateTime sTime = GetDateTimeFromString(trip[0]);
            OutputText(String.Format("{0}Start time: {1}\r\n", TabChars, sTime));

            DateTime eTime = GetDateTimeFromString(trip[1]);
            OutputText(String.Format("{0}End time: {1}\r\n", TabChars, eTime));

            OutputText(String.Format("{0}Start Position: Lat: {1} Lon: {2}\r\n", TabChars, trip[2], trip[3]));

            OutputText(String.Format("{0}End Position: Lat: {1} Lon: {2}\r\n", TabChars, trip[4], trip[5]));

            OutputText(String.Format("{0}Start mileage: {1}(meters)\r\n", TabChars, trip[6]));

            OutputText(String.Format("{0}End mileage: {1}(meters)\r\n", TabChars, trip[7]));

            OutputText(String.Format("{0}Start fuel consumption(cal:{1}): {2}\r\n", TabChars, trip[8], trip[9]));

            OutputText(String.Format("{0}End fuel consumption(cal:{1}): {2}\r\n", TabChars, trip[8], trip[10]));

            OutputText(String.Format("{0}Idle time: {1}seconds\r\n", TabChars, trip[11]));

            OutputText(String.Format("{0}Max speed: {1}\r\n", TabChars, trip[12]));

            OutputText(String.Format("{0}Max RPM: {1}\r\n", TabChars, trip[13]));
        }

        void TrpDecodeFromBinary(byte[] info)
        {
            if (info.Length != 0x31)
                return;

            string TabChars = "    ";
            OutputText(TabChars + "Trip report:" + "\r\n");
            TabChars = TabChars + TabChars;

            int pos = 0;

            UInt32 startTime = ReadUint32(info, pos);
            pos += 4;
            DateTime timeOffset = new DateTime(2000, 1, 1, 0, 0, 0);
            DateTime sTime = new DateTime(timeOffset.Ticks + (long)startTime * 10000000);
            OutputText(String.Format("{0}Start time: {1}\r\n", TabChars, sTime));

            UInt32 endTime = ReadUint32(info, pos);
            pos += 4;
            DateTime eTime = new DateTime(timeOffset.Ticks + (long)endTime * 10000000);
            OutputText(String.Format("{0}End time: {1}\r\n", TabChars, eTime));

            int startLat = ReadInt32(info, pos);
            pos += 4;
            int startLon = ReadInt32(info, pos);
            pos += 4;
            OutputText(String.Format("{0}Start Position: Lat: {1:0.000000} Lon: {2:0.000000}\r\n", TabChars, (double)startLat / 1000000, (double)startLon / 1000000));

            int endLat = ReadInt32(info, pos);
            pos += 4;
            int endLon = ReadInt32(info, pos);
            pos += 4;
            OutputText(String.Format("{0}End Position: Lat: {1:0.000000} Lon: {2:0.000000}\r\n", TabChars, (double)endLat / 1000000, (double)endLon / 1000000));

            UInt32 startMile = ReadUint32(info, pos);
            pos += 4;
            OutputText(String.Format("{0}Start mileage: {1}(meters)\r\n", TabChars, startMile));

            UInt32 endMile = ReadUint32(info, pos);
            pos += 4;
            OutputText(String.Format("{0}End mileage: {1}(meters)\r\n", TabChars, endMile));

            byte fuelCalId = ReadUnsignedByte(info, pos);
            pos += 1;

            UInt32 startFuel = ReadUint32(info, pos);
            pos += 4;
            OutputText(String.Format("{0}Start fuel consumption(cal:{1}): {2}\r\n", TabChars, fuelCalId, startFuel));

            UInt32 endFuel = ReadUint32(info, pos);
            pos += 4;
            OutputText(String.Format("{0}End fuel consumption(cal:{1}): {2}\r\n", TabChars, fuelCalId, endFuel));

            UInt32 idleSec = ReadUint32(info, pos);
            pos += 4;
            OutputText(String.Format("{0}Idle time: {1}seconds\r\n", TabChars, idleSec));

            UInt16 maxSpd = ReadUint16(info, pos);
            pos += 2;
            OutputText(String.Format("{0}Max speed: {1}\r\n", TabChars, maxSpd));

            UInt16 maxRpm = ReadUint16(info, pos);
            pos += 2;
            OutputText(String.Format("{0}Max RPM: {1}\r\n", TabChars, maxRpm));
        }

        void SatDecodeFromString(string str)
        {
            string[] paras = str.Split(';');
            if (paras.GetLength(0) != 3)
                return;
            String strSat = String.Format("    GPS Sat: {0}dBH,{1}dBH,{2}dBH\r\n",
                paras[0], paras[1], paras[2]);
            OutputText(strSat);
        }

        void SatDecodeFromBinary(byte[] info)
        {
            if (info.Length != 3)
                return;
            OutputText(String.Format("    GPS Sat: {0}dBH,{1}dBH,{2}dBH\r\n",
                ReadUnsignedByte(info, 0), ReadUnsignedByte(info, 1), ReadUnsignedByte(info, 2)));
        }

        void EgtDecodeFromString(string str)
        {
            OutputText(String.Format("    Engine seconds: {0}(seconds)\r\n", str));
        }

        void EgtDecodeFromBinary(byte[] info)
        {
            if (info.Length != 4)
                return;
            OutputText(String.Format("    Engine seconds: {0}(seconds)\r\n", ReadUint32(info, 0)));
        }

        void BrvDecodeFromString(string str)
        {
            string[] paras = str.Split(';');
            if (paras.GetLength(0) != 2 && paras.GetLength(0) != 3)
                return;
            if (paras[0] == "0")
            {
                if (paras.GetLength(0) != 2)
                    return;
                string[] remote_keys = { "Personal", "Business", "End trip", "Fun1", "Fun2", "Fun3", "Fun4" };
                byte key_val = Convert.ToByte(paras[1], 16);
                int i;
                for (i = 0; i < 8; i++)
                {
                    if ((key_val & (0x01 << i)) != 0)
                        break;
                }
                String strBrv = String.Format("    Remote Event: Key pressed--{0}\r\n", remote_keys[i]);
                OutputText(strBrv);
            }
            else if (paras[0] == "1")
            {
                if (paras.GetLength(0) != 2)
                    return;
                String strBrv = String.Format("    Remote Event: Batt percent--{0}%\r\n", paras[1]);
                OutputText(strBrv);
            }
            else if (paras[0] == "2")
            {
                if (paras.GetLength(0) != 3)
                    return;
                String strBrv = String.Format("    Remote Event: Remote paired--FleetID:{0}, UniqueID:{1}\r\n", paras[1], paras[2]);
                OutputText(strBrv);
            }
        }

        void BrvDecodeFromBinary(byte[] info, int evt_type)
        {
            switch (evt_type)
            {
                case 0:
                    {
                        if (info.GetLength(0) != 1)
                            break;
                        string[] remote_keys = { "Personal", "Business", "End trip", "Fun1", "Fun2", "Fun3", "Fun4" };
                        byte key_val = info[0];
                        int i;
                        for (i = 0; i < 8; i++)
                        {
                            if ((key_val & (0x01 << i)) != 0)
                                break;
                        }
                        String strBrv = String.Format("    Remote Event: Key pressed--{0}\r\n", remote_keys[i]);
                        OutputText(strBrv);
                        break;
                    }
                case 1:
                    {
                        if (info.GetLength(0) != 1)
                            break;
                        String strBrv = String.Format("    Remote Event: Batt percent--{0}%\r\n", info[0]);
                        OutputText(strBrv);
                        break;
                    }
                case 2:
                    {
                        if (info.GetLength(0) != 6)
                            break;
                        String strBrv = String.Format("    Remote Event: Remote paired--FleetID:{0:X08}, UniqueID:{1:X04}\r\n", ReadUint32(info, 0), ReadUint16(info, 4));
                        OutputText(strBrv);
                        break;
                    }
                default:
                    break;
            }
        }

        void CmdDecodeFromString(string strCmd, string strResp)
        {
            OutputText(String.Format("    Command responded:{0}:{1}\r\n", strCmd, strResp));
        }

        void ObdService0102Decode(byte[] value, int service, int pid)
        {
            String str;
            switch (pid)
            {
                case 0x01:
                    {
                        if (value.Length != 4)
                            return;
                        str = String.Format("        [{0:X2}][{1:X2}]: DTC_CNT: {2}, MIL: {3}\r\n",
                                        service,
                                        pid,
                                        value[0] & 0x7F,
                                        (value[0] & 0x80) != 0 ? "ON" : "OFF");
                        str += String.Format("                  MIS_SUP:{0}, FUEL_SUP: {1}, CCM_SUP: {2}, MIS_RDY: {3}, FUEL_RDY: {4}, CCM_RDY: {5}\r\n",
                                        ((value[1] & 0x01) != 0 ? "YES" : "NO"),
                                        ((value[1] & 0x02) != 0 ? "YES" : "NO"),
                                        ((value[1] & 0x04) != 0 ? "YES" : "NO"),
                                        ((value[1] & 0x10) != 0 ? "YES" : "NO"),
                                        ((value[1] & 0x20) != 0 ? "YES" : "NO"),
                                        ((value[1] & 0x40) != 0 ? "YES" : "NO"));
                        str += String.Format("                  CAT_SUP: {0}, HCAT_SUP: {1}, EVAP_SUP: {2}, AIR_SUP: {3}, ACRF_SUP: {4}, O2S_SUP: {5}, HTR_SUP: {6}, EGR_SUP: {7}\r\n",
                                        ((value[2] & 0x01) != 0 ? "YES" : "NO"),
                                        ((value[2] & 0x02) != 0 ? "YES" : "NO"),
                                        ((value[2] & 0x04) != 0 ? "YES" : "NO"),
                                        ((value[2] & 0x08) != 0 ? "YES" : "NO"),
                                        ((value[2] & 0x10) != 0 ? "YES" : "NO"),
                                        ((value[2] & 0x20) != 0 ? "YES" : "NO"),
                                        ((value[2] & 0x40) != 0 ? "YES" : "NO"),
                                        ((value[2] & 0x80) != 0 ? "YES" : "NO"));
                        str += String.Format("                  CAT_RDY: {0}, HCAT_RDY: {1}, EVAP_RDY: {2}, AIR_RDY: {3}, ACRF_RDY: {4}, O2S_RDY: {5}, HTR_RDY: {6}, EGR_RDY: {7}\r\n",
                                        ((value[3] & 0x01) != 0 ? "YES" : "NO"),
                                        ((value[3] & 0x02) != 0 ? "YES" : "NO"),
                                        ((value[3] & 0x04) != 0 ? "YES" : "NO"),
                                        ((value[3] & 0x08) != 0 ? "YES" : "NO"),
                                        ((value[3] & 0x10) != 0 ? "YES" : "NO"),
                                        ((value[3] & 0x20) != 0 ? "YES" : "NO"),
                                        ((value[3] & 0x40) != 0 ? "YES" : "NO"),
                                        ((value[3] & 0x80) != 0 ? "YES" : "NO"));
                        break;
                    }
                case 0x04:
                    {
                        if (value.Length != 1)
                            return;
                        double clv  = ((double)value[0]) * 100 / 255;
                        str = String.Format("        [{0:X2}][{1:X2}]: {2:F}%--Calculated LOAD Value\r\n",
                                        service,
                                        pid,
                                        clv);
                        break;
                    }
                case 0x05:
                    {
                        if (value.Length != 1)
                            return;
                        int ect = value[0];
                        ect -= 40;
                        str = String.Format("        [{0:X2}][{1:X2}]: {2}Celsius--Engine Coolant Temperature\r\n",
                                        service,
                                        pid,
                                        ect);
                        break;
                    }
                case 0x06:
                    {
                        if (value.Length == 1)
                        {
                            str = String.Format("        [{0:X2}][{1:X2}]: Bank1:{2:F}%%--Short Term Fuel Trim\r\n",
                                        service,
                                        pid,
                                        (((double)value[0] - 128) / 128) * 100);
                        }
                        else if (value.Length == 2)
                        {
                            str = String.Format("        [{0:X2}][{1:X2}]: Bank1:{2:F}%,Bank3:{3:F}%--Short Term Fuel Trim\r\n",
                                        service,
                                        pid,
                                        (((double)value[0] - 128) / 128) * 100,
                                        (((double)value[1] - 128) / 128) * 100);
                        }
                        else
                            return;
                        break;
                    }
                case 0x07:
                    {
                        if (value.Length == 1)
                        {
                            str = String.Format("        [{0:X2}][{1:X2}]: Bank1:{2:F}%%--Long Term Fuel Trim\r\n",
                                        service,
                                        pid,
                                        (((double)value[0] - 128) / 128) * 100);
                        }
                        else if (value.Length == 2)
                        {
                            str = String.Format("        [{0:X2}][{1:X2}]: Bank1:{2:F}%,Bank3:{3:F}%--Long Term Fuel Trim\r\n",
                                        service,
                                        pid,
                                        (((double)value[0] - 128) / 128) * 100,
                                        (((double)value[1] - 128) / 128) * 100);
                        }
                        else
                            return;
                        break;
                    }
                case 0x08:
                    {
                        if (value.Length == 1)
                        {
                            str = String.Format("        [{0:X2}][{1:X2}]: Bank2:{2:F}%%--Short Term Fuel Trim\r\n",
                                        service,
                                        pid,
                                        (((double)value[0] - 128) / 128) * 100);
                        }
                        else if (value.Length == 2)
                        {
                            str = String.Format("        [{0:X2}][{1:X2}]: Bank2:{2:F}%,Bank4:{3:F}%--Short Term Fuel Trim\r\n",
                                        service,
                                        pid,
                                        (((double)value[0] - 128) / 128) * 100,
                                        (((double)value[1] - 128) / 128) * 100);
                        }
                        else
                            return;
                        break;
                    }
                case 0x09:
                    {
                        if (value.Length == 1)
                        {
                            str = String.Format("        [{0:X2}][{1:X2}]: Bank2:{2:0.2}%%--Long Term Fuel Trim\r\n",
                                        service,
                                        pid,
                                        (((double)value[0] - 128) / 128) * 100);
                        }
                        else if (value.Length == 2)
                        {
                            str = String.Format("        [{0:X2}][{1:X2}]: Bank2:{2:0.2}%,Bank4:{3:0.2}%--Long Term Fuel Trim\r\n",
                                        service,
                                        pid,
                                        (((double)value[0] - 128) / 128) * 100,
                                        (((double)value[1] - 128) / 128) * 100);
                        }
                        else
                            return;
                        break;
                    }
                case 0x0A:
                    {
                        if (value.Length != 1)
                            return;
                        str = String.Format("        [{0:X2}][{1:X2}]: {2}kPa--Fuel Rail Pressure\r\n",
                                        service,
                                        pid,
                                        (int)value[0] * 3);
                        break;
                    }
                case 0x0B:
                    {
                        if (value.Length != 1)
                            return;
                        str = String.Format("        [{0:X2}][{1:X2}]: {2}kPa--Intake Manifold Absolute Pressure\r\n",
                                        service,
                                        pid,
                                        value[0]);
                        break;
                    }
                case 0x0C:
                    {
                        if (value.Length != 2)
                            return;
                        double rpm = ((double)(value[0] * 256 + value[1])) / 4;
                        str = String.Format("        [{0:X2}][{1:X2}]: {2:F}rpm--Engine RPM\r\n",
                                        service,
                                        pid,
                                        rpm);
                        break;
                    }
                case 0x0D:
                    {
                        if (value.Length != 1)
                            return;
                        int speed = value[0];
                        str = String.Format("        [{0:X2}][{1:X2}]: {2}km/h--Vehicle Speed\r\n",
                                        service,
                                        pid,
                                        speed);
                        break;
                    }
                case 0x0E:
                    {
                        if (value.Length != 1)
                            return;
                        str = String.Format("        [{0:X2}][{1:X2}]: {2:F}degree--Ignition Timing Advance for #1 Cylinder\r\n",
                                        service,
                                        pid,
                                        ((double)value[0] - 128) / 2);
                        break;
                    }
                case 0x0F:
                    {
                        if (value.Length != 1)
                            return;
                        int iat = value[0];
                        iat -= 40;
                        str = String.Format("        [{0:X2}][{1:X2}]: {2}Celsius--Intake Air Temperature\r\n",
                                        service,
                                        pid,
                                        iat);
                        break;
                    }
                case 0x10:
                    {
                        if (value.Length != 2)
                            return;
                        double maf = ((double)(value[0] * 256 + value[1])) / 100;
                        str = String.Format("        [{0:X2}][{1:X2}]: {2:F}g/s--Air Flow Rate from Mass Air Flow Sensor\r\n",
                                        service,
                                        pid,
                                        maf);
                        break;
                    }
                case 0x11:
                    {
                        if (value.Length != 1)
                            return;
                        double position = ((double)value[0]) * 100 / 255;
                        str = String.Format("        [{0:X2}][{1:X2}]: {2:F}%--Absolute Throttle Position\r\n",
                                        service,
                                        pid,
                                        position);
                        break;
                    }
                case 0x21:
                    {
                        if (value.Length != 2)
                            return;
                        int distance = 256 * value[0] + value[1];
                        str = String.Format("        [{0:X2}][{1:X2}]: {2}km--Distance Travelled While MIL is Activated\r\n",
                                        service,
                                        pid,
                                        distance);
                        break;
                    }
                case 0x2F:
                    {
                        if (value.Length != 1)
                            return;
                        double percent = ((double)value[0]) * 100 /255;
                        str = String.Format("        [{0:X2}][{1:X2}]: {2:F}%--Fuel level\r\n",
                                        service,
                                        pid,
                                        percent);
                        break;
                    }
                case 0x31:
                    {
                        if (value.Length != 2)
                            return;
                        int distance = 256 * value[0] + value[1];
                        str = String.Format("        [{0:X2}][{1:X2}]: {2}km--Distance traveled since codes cleared\r\n",
                                        service,
                                        pid,
                                        distance);
                        break;
                    }
                default:
                    {
                        string hex = "";
                        for (int i = 0; i < value.Length; i++)
                        {
                            hex += String.Format("{0:X2} ", value[i]);
                        }
                        str = String.Format("        [{0:X2}][{1:X2}]: {2}\r\n",
                                        service,
                                        pid,
                                        hex);
                        break;
                    }
            }
            OutputText(str);
        }

        void ObdService03Decode(byte[] value)
        {
            int offset;
            if (value.Length % 2 != 0)
                offset = 1;
            else
                offset = 0;
            String strDtcs = "";
            String[] dtcChars = { "P", "C", "B", "U" };
            for (int i = 0; i < value.Length / 2; i++)
            {
                byte dtcA = value[2 * i + offset];
                byte dtcB = value[2 * i + offset + 1];
                if (dtcA == 0 && dtcB == 0)
                    continue;
                strDtcs += String.Format("{0}{1:X2}{2:X2}/",
                          dtcChars[((dtcA >> 6) & 0x03)],
                          (dtcA & 0x3F),
                          dtcB);

            }
            strDtcs = strDtcs.Substring(0, strDtcs.Length - 1);
            strDtcs = String.Format("        [03]: {0}\r\n",
                                        strDtcs);
            OutputText(strDtcs);
        }

        void ObdService21Decode(byte[] value)
        {
            string hex = "";
            for (int i = 0; i < value.Length; i++)
            {
                hex += String.Format("{0:X2} ", value[i]);
            }
            string str = String.Format("        [{0:X2}]: {1}\r\n",
                            0x21,
                            hex);
            OutputText(str);
        }

        void ObdService22Decode(byte[] value)
        {
            string hex = "";
            for (int i = 0; i < value.Length; i++)
            {
                hex += String.Format("{0:X2} ", value[i]);
            }
            string str = String.Format("        [{0:X2}]: {1}\r\n",
                            0x22,
                            hex);
            OutputText(str);
        }

        void UdsService22Decode(byte[] value, UInt16 pid)//For VW Amarok
        {
            String str;
            switch (pid)
            {
                case 0x16A9://Distance
                    {
                        if (value.Length != 4)
                            return;
                        UInt32 distance = ReadUint32(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2}km--Distance\r\n",
                                        0x22,
                                        pid,
                                        distance);
                        break;
                    }
                case 0x1047://Engine torque
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 torque = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2:0.0}Nm--Engine torque\r\n",
                                        0x22,
                                        pid,
                                        0.1 * torque);
                        break;
                    }
                case 0x1221://Accelerator pedal
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 pedal = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2:0.0}mV--Accelerator pedal\r\n",
                                        0x22,
                                        pid,
                                        0.2 * pedal);
                        break;
                    }
                case 0xF449://Accelerator position
                    {
                        if (value.Length != 1)
                            return;
                        Byte pos = ReadUnsignedByte(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2:0.00}%--Accelerator positon\r\n",
                                        0x22,
                                        pid,
                                        (double)pos * 100 / 255);
                        break;
                    }
                case 0x17D6://Brake actuated status
                    {
                        if (value.Length != 1)
                            return;
                        byte brake = ReadUnsignedByte(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2}--Brake actuated status\r\n",
                                        0x22,
                                        pid,
                                        brake);
                        break;
                    }
                case 0xF40C://Engine speed
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 rpm = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2:F}rpm--Engine speed\r\n",
                                        0x22,
                                        pid,
                                        0.25 * rpm);
                        break;
                    }
                case 0x111A://Fuel consumption
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 consumption = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2:F}l/h--Fuel consumption\r\n",
                                        0x22,
                                        pid,
                                        0.01 * consumption);
                        break;
                    }
                case 0x100C://Fuel Level
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 level = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2:F}l--Fuel Level\r\n",
                                        0x22,
                                        pid,
                                        0.01 * level);
                        break;
                    }
                case 0xF423://Fuel pressure
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 pressure = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2}kPa--Fuel pressure\r\n",
                                        0x22,
                                        pid,
                                        10 * pressure);
                        break;
                    }
                case 0x121E://Fuel pressure regulator value
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 val = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2}hPa--Fuel pressure regulator value\r\n",
                                        0x22,
                                        pid,
                                        100 * val);
                        break;
                    }
                case 0x11BF://Fuel pressure regulator value
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 val = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2:0.00}%--Fuel pressure regulator value\r\n",
                                        0x22,
                                        pid,
                                        0.01 * val);
                        break;
                    }
                case 0x106B://Limitation torque
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 val = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2:F}Nm--Limitation torque\r\n",
                                        0x22,
                                        pid,
                                        0.1 * val);
                        break;
                    }
                case 0x116B://Rail pressure regulation
                    {
                        if (value.Length != 1)
                            return;
                        byte regulation = ReadUnsignedByte(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2}--Rail pressure regulation\r\n",
                                        0x22,
                                        pid,
                                        regulation);
                        break;
                    }
                case 0x104C://Air mass: specified value
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 val = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2:F}mg/stroke--Air mass: specified value\r\n",
                                        0x22,
                                        pid,
                                        0.1 * val);
                        break;
                    }
                case 0x1635://Sensor f charge air press betw turbochargers
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 val = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2:F}mV--Sensor f charge air press betw turbochargers\r\n",
                                        0x22,
                                        pid,
                                        0.2 * val);
                        break;
                    }
                case 0x1634://Sensor for charge air press
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 val = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2:F}hPa--Sensor for charge air press\r\n",
                                        0x22,
                                        pid,
                                        0.2 * val);
                        break;
                    }
                case 0x100D://Selected gear
                    {
                        if (value.Length != 1)
                            return;
                        byte gear = ReadUnsignedByte(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2}--Selected gear\r\n",
                                        0x22,
                                        pid,
                                        gear);
                        break;
                    }
                case 0x162D://Fuel temperature
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 val = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2:0.0}Celsius--Fuel temperature\r\n",
                                        0x22,
                                        pid,
                                        (double)val * 0.1 - 273);
                        break;
                    }
                case 0xF411://Absolute Throttle Position
                    {
                        if (value.Length != 1)
                            return;
                        Byte pos = ReadUnsignedByte(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2:0.00}%--Absolute Throttle Position\r\n",
                                        0x22,
                                        pid,
                                        (double)pos * 100 / 255);
                        break;
                    }
                case 0xF40D://Vehicle speed
                    {
                        if (value.Length != 1)
                            return;
                        Byte val = ReadUnsignedByte(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2}km/h--Vehicle speed\r\n",
                                        0x22,
                                        pid,
                                        val);
                        break;
                    }
                case 0xF405://Engine Coolant Temperature
                    {
                        if (value.Length != 1)
                            return;
                        Byte val = ReadUnsignedByte(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2:F}Celsius--Engine Coolant Temperature\r\n",
                                        0x22,
                                        pid,
                                        (double)val - 40);
                        break;
                    }
                case 0x2222://Indicator lamps
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 val = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2}--Airbag indicator lamp\r\n",
                                        0x22,
                                        pid,
                                        (val & 0x0100) == 0? "Not active" : "Active");
                        str += String.Format("        [{0:X2}][{1:X4}]: {2}--ABS indicator lamp\r\n",
                                        0x22,
                                        pid,
                                        (val & 0x0004) == 0 ? "Not active" : "Active");
                        break;
                    }
                case 0x2223://MIL
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 val = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2}--Malfunction indicator lamp(MIL)\r\n",
                                        0x22,
                                        pid,
                                        (val & 0x4000) == 0? "Not active" : "Active");
                        break;
                    }
                case 0x2260://ESI: remaining distance
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 val = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2}km--ESI: remaining distance\r\n",
                                        0x22,
                                        pid,
                                        val);
                        break;
                    }
                case 0x2261://ESI: remaining running days
                    {
                        if (value.Length != 2)
                            return;
                        UInt16 val = ReadUint16(value, 0);
                        str = String.Format("        [{0:X2}][{1:X4}]: {2}day--ESI: remaining running days\r\n",
                                        0x22,
                                        pid,
                                        val);
                        break;
                    }
                default:
                    {
                        string hex = "";
                        for (int i = 0; i < value.Length; i++)
                        {
                            hex += String.Format("{0:X2} ", value[i]);
                        }
                        str = String.Format("        [{0:X2}][{1:X4}]: {2}\r\n",
                                        0x22,
                                        pid,
                                        hex);
                        break;
                    }
            }
            OutputText(str);
        }

        void ObdCanSnifferDecode(byte[] value)
        {
            string addr = "";
            for (int i = 0; i < 2; i++)
            {
                addr += String.Format("{0:X2} ", value[i]);
            }

            string hex = "";
            for (int i = 2; i < value.Length; i++)
            {
                hex += String.Format("{0:X2} ", value[i]);
            }
            string str = String.Format("        [CanFrame]: [Address]: {0}, {1}\r\n",
                            addr,
                            hex);
            OutputText(str);
        }

        void J1939PgnDecode(byte[] value, int pgn)
        {
            string strCan;
            string hex = "";
            for (int i = 0; i < value.Length; i++)
            {
                hex += String.Format("{0:X2} ", value[i]);
            }
            strCan = String.Format("        PGN{0}: {1}--- ",
                    pgn,
                    hex);
            string blanks = "                    ";
            switch (pgn)
            {
                case 61444://(0x00F004)Engine speed
                    strCan += "Electronic Engine Controller 1\r\n";
                    strCan += String.Format("{0}{1}--Engine Torque Mode\r\n",
                        blanks,
                        ReadUnsignedByte(value, 0) & 0x0F);
                    strCan += String.Format("{0}{1:0.000}%--Actual Engine - Percent Torque High Resolution\r\n",
                        blanks,
                        0.125 * ((ReadUnsignedByte(value, 0) >> 4) & 0x0F));
                    strCan += String.Format("{0}{1}--Driver's Demand Engine - Percent Torque\r\n",
                        blanks,
                        ReadUnsignedByte(value, 1));
                    strCan += String.Format("{0}{1}--Actual Engine - Percent Torque\r\n",
                        blanks,
                        ReadUnsignedByte(value, 2));
                    strCan += String.Format("{0}{1:0.000}RPM--Engine speed\r\n",
                        blanks,
                            0.125 * ReverseBytes(ReadUint16(value, 3)));
                    strCan += String.Format("{0}{1}--Source Address of Controlling Device for Engine Control\r\n",
                        blanks,
                            ReadUnsignedByte(value, 5));
                    strCan += String.Format("{0}{1}--Engine Starter Mode\r\n",
                        blanks,
                            ReadUnsignedByte(value, 6) & 0x0F);
                    strCan += String.Format("{0}{1}%--Engine Demand – Percent Torque\r\n",
                        blanks,
                            -125 + ReadUnsignedByte(value, 7));
                    break;
                case 65132://(0x00FE6C)Vehicle speed
                    strCan += "Tachograph\r\n";
                    strCan += String.Format("{0}{1:0.000}km/h--Vehicle speed\r\n",
                        blanks,
                            (double)ReverseBytes(ReadUint16(value, 6)) / 256);
                    break;
                case 65217://(0x00FEC1)High Resolution Total Vehicle Distance
                    strCan += "High Resolution Vehicle Distance\r\n";
                    strCan += String.Format("{0}{1:0.000}km--High Resolution Total Vehicle Distance\r\n",
                        blanks,
                            (double)ReverseBytes(ReadUint32(value, 0)) / 200);
                    break;
                case 65248://(0x00FEE0)Vehicle Distance
                    strCan += "Vehicle Distance\r\n";
                    strCan += String.Format("{0}{1:0.000}km--Trip Distance\r\n",
                        blanks,
                            (double)ReverseBytes(ReadUint32(value, 0)) / 8);
                    strCan += String.Format("{0}{1:0.000}km--Total Vehicle Distance\r\n",
                        blanks,
                            (double)ReverseBytes(ReadUint32(value, 4)) / 8);
                    break;
                case 65262://(0x00FEEE)Engine Coolant Temperature
                    strCan += "Engine Temperature 1\r\n";
                    strCan += String.Format("{0}{1}deg C--Engine Coolant Temperature\r\n",
                        blanks,
                            (double)ReadUnsignedByte(value, 0) - 40);
                    break;
                case 65253://(0x00FEE5)Engine Hours, Revolutions
                    strCan += "Engine Hours, Revolutions\r\n";
                    strCan += String.Format("{0}{1:0.00}H--Engine Total Hours of Operation\r\n",
                        blanks,
                            (double)ReverseBytes(ReadUint32(value, 0)) * 0.05);
                    strCan += String.Format("{0}{1:0}r--Engine Total Revolutions\r\n",
                       blanks,
                             (double)ReverseBytes(ReadUint32(value, 4)) * 1000);
                    break;
                case 65256://(0x00FEE8)Vehicle Direction/Speed
                    strCan += "Vehicle Direction/Speed\r\n";
                    strCan += String.Format("{0}{1:0.00}deg--Compass Bearing\r\n",
                        blanks,
                            (double)ReverseBytes(ReadUint16(value, 0)) / 128);
                    strCan += String.Format("{0}{1:0.00}km/h--Navigation-Based Vehicle Speed\r\n",
                        blanks,
                            (double)ReverseBytes(ReadUint16(value, 2)) / 256);
                    strCan += String.Format("{0}{1:0.00}deg--Pitch\r\n",
                         blanks,
                           (double)ReverseBytes(ReadUint16(value, 4)) / 128 - 200);
                    strCan += String.Format("{0}{1:0.00}m--Altitude\r\n",
                         blanks,
                           (double)ReverseBytes(ReadUint16(value, 6)) / 8 - 2500);
                    break;
                case 65257://(0x00FEE9)Fuel consumption
                    strCan += "Fuel Consumption (Liquid)\r\n";
                    strCan += String.Format("{0}{1:0.0}L--Engine trip fuel\r\n",
                        blanks,
                            (double)ReverseBytes(ReadUint32(value, 0)) * 0.5);
                    strCan += String.Format("{0}{1:0.0}L--Engine total fuel used\r\n",
                         blanks,
                           (double)ReverseBytes(ReadUint32(value, 4)) * 0.5);
                    break;
                case 61443://(0x00F003)Accelerator Pedal Position
                    strCan += "Electronic Engine Controller 2\r\n";
                    strCan += String.Format("{0}{1:0.0}%--Accelerator Pedal Position\r\n",
                           blanks,
                        (double)ReadUnsignedByte(value, 1) * 0.4);
                    break;
                case 65259://(0x00FEEB)//Component Identification
                    strCan += "Component Identification\r\n";
                    string strId = System.Text.Encoding.Default.GetString(value);
                    string[] strIds = strId.Split('*');
                    if (strIds.GetLength(0) >= 1)
                    {
                        strCan += String.Format("{0}{1}--Make\r\n",
                            blanks,
                            strIds[0]);
                    }
                    if (strIds.GetLength(0) >= 2)
                    {
                        strCan += String.Format("{0}{1}--Model\r\n",
                            blanks,
                            strIds[1]);
                    }
                    if (strIds.GetLength(0) >= 3)
                    {
                        strCan += String.Format("{0}{1}--Serial Number\r\n",
                            blanks,
                            strIds[2]);
                    }
                    if (strIds.GetLength(0) >= 4)
                    {
                        strCan += String.Format("{0}{1}--Unit Number(Power Unit)\r\n",
                            blanks,
                            strIds[3]);
                    }
                    break;
                case 65263://(0x00FEEF)Engine Fluid Level/Pressure 1
                    strCan += "Engine Fluid Level/Pressure 1\r\n";
                    strCan += String.Format("{0}{1}kPa--Engine Fuel Delivery Pressure\r\n",
                        blanks,
                        4 * ReadUnsignedByte(value, 0));
                    strCan += String.Format("{0}{1}kPa--Engine Extended Crankcase Blow-by Pressure\r\n",
                        blanks,
                        0.05 * ReadUnsignedByte(value, 1));
                    strCan += String.Format("{0}{1}%--Engine Oil Level\r\n",
                        blanks,
                        0.4 * ReadUnsignedByte(value, 2));
                    strCan += String.Format("{0}{1}kPa--Engine Oil Pressure\r\n",
                        blanks,
                        4 * ReadUnsignedByte(value, 3));
                    strCan += String.Format("{0}{1:0.000}kPa--Engine Crankcase Pressure\r\n",
                        blanks,
                        -225 + (float)ReverseBytes(ReadUint16(value, 4)) / 128);
                    strCan += String.Format("{0}{1}kPa--Engine Coolant Pressure\r\n",
                        blanks,
                        2 * ReadUnsignedByte(value, 6));
                    strCan += String.Format("{0}{1}%--Engine Coolant Level\r\n",
                        blanks,
                        0.4 * ReadUnsignedByte(value, 7));
                    break;
                case 65265://(0x00FEF1)Cruise Control/Vehicle Speed
                    strCan += "Cruise Control/Vehicle Speed\r\n";
                    strCan += String.Format("{0}{1}--Two Speed Axle Switch\r\n",
                        blanks,
                        ReadUnsignedByte(value, 0) & 0x03);
                    strCan += String.Format("{0}{1}--Parking Brake Switch\r\n",
                        blanks,
                        (ReadUnsignedByte(value, 0) >> 2) & 0x03);
                    strCan += String.Format("{0}{1}--Cruise Control Pause Switch\r\n",
                        blanks,
                        (ReadUnsignedByte(value, 0) >> 4) & 0x03);
                    strCan += String.Format("{0}{1}--Park Brake Release Inhibit Request\r\n",
                        blanks,
                        (ReadUnsignedByte(value, 0) >> 6) & 0x03);
                    strCan += String.Format("{0}{1:0.0}km/h--Wheel-Based Vehicle Speed\r\n",
                        blanks,
                        (float)ReverseBytes(ReadUint16(value, 1)) / 256);
                    strCan += String.Format("{0}{1}--Cruise Control Active\r\n",
                        blanks,
                        ReadUnsignedByte(value, 3) & 0x03);
                    strCan += String.Format("{0}{1}--Cruise Control Enable Switch\r\n",
                        blanks,
                        (ReadUnsignedByte(value, 3) >> 2) & 0x03);
                    strCan += String.Format("{0}{1}--Brake Switch\r\n",
                        blanks,
                        (ReadUnsignedByte(value, 3) >> 4) & 0x03);
                    strCan += String.Format("{0}{1}--Clutch Switch\r\n",
                        blanks,
                        (ReadUnsignedByte(value, 3) >> 6) & 0x03);
                    strCan += String.Format("{0}{1}--Cruise Control Set Switch\r\n",
                        blanks,
                        ReadUnsignedByte(value, 4) & 0x03);
                    strCan += String.Format("{0}{1}--Cruise Control Coast (Decelerate) Switch\r\n",
                        blanks,
                        (ReadUnsignedByte(value, 4) >> 2) & 0x03);
                    strCan += String.Format("{0}{1}--Cruise Control Resume Switch\r\n",
                        blanks,
                        (ReadUnsignedByte(value, 4) >> 4) & 0x03);
                    strCan += String.Format("{0}{1}--Cruise Control Accelerate Switch\r\n",
                        blanks,
                        (ReadUnsignedByte(value, 4) >> 6) & 0x03);
                    strCan += String.Format("{0}{1}km/h--Cruise Control Set Speed\r\n",
                        blanks,
                        ReadUnsignedByte(value, 5));
                    strCan += String.Format("{0}{1}--PTO Governor State\r\n",
                        blanks,
                        ReadUnsignedByte(value, 6) & 0x1F);
                    strCan += String.Format("{0}{1}--Cruise Control States\r\n",
                        blanks,
                        (ReadUnsignedByte(value, 6) >> 5) & 0x07);
                    strCan += String.Format("{0}{1}--Engine Idle Increment Switch\r\n",
                        blanks,
                        ReadUnsignedByte(value, 7) & 0x03);
                    strCan += String.Format("{0}{1}--Engine Idle Decrement Switch\r\n",
                        blanks,
                        (ReadUnsignedByte(value, 7) >> 2) & 0x03);
                    strCan += String.Format("{0}{1}--Engine Test Mode Switch\r\n",
                        blanks,
                        (ReadUnsignedByte(value, 7) >> 4) & 0x03);
                    strCan += String.Format("{0}{1}--Engine Shutdown Override Switchh\r\n",
                        blanks,
                        (ReadUnsignedByte(value, 7) >> 6) & 0x03);
                    break;
                case 65270://(0x00FEF6)Inlet/Exhaust Conditions 1
                    strCan += "Inlet/Exhaust Conditions 1\r\n";
                    strCan += String.Format("{0}{1:0.0}kPa--Engine Diesel Particulate Filter Inlet Pressure\r\n",
                        blanks,
                        0.5 * ReadUnsignedByte(value, 0));
                    strCan += String.Format("{0}{1}kPa--Engine Intake Manifold #1 Pressure\r\n",
                        blanks,
                        2 * ReadUnsignedByte(value, 1));
                    strCan += String.Format("{0}{1}deg C--Engine Intake Manifold 1 Temperature\r\n",
                        blanks,
                        -40 + ReadUnsignedByte(value, 2));
                    strCan += String.Format("{0}{1}kPa--Engine Air Inlet Pressure\r\n",
                        blanks,
                        2 * ReadUnsignedByte(value, 3));
                    strCan += String.Format("{0}{1:0.00}kPa--Engine Air Filter 1 Differential Pressure\r\n",
                        blanks,
                        0.05 * ReadUnsignedByte(value, 4));
                    strCan += String.Format("{0}{1:0.00}deg C--Engine Exhaust Gas Temperature\r\n",
                        blanks,
                        -273 + 0.03125 * ReverseBytes(ReadUint16(value, 5)));
                    strCan += String.Format("{0}{1:0.0}kPa--Engine Coolant Filter Differential Pressure\r\n",
                        blanks,
                        0.5 * ReadUnsignedByte(value, 7));
                    break;
                case 65271://(0x00FEF7)Vehicle Electrical Power 1
                    strCan += "Vehicle Electrical Power 1\r\n";
                    strCan += String.Format("{0}{1}A--Net Battery Current\r\n",
                        blanks,
                        -125 + ReadUnsignedByte(value, 0));
                    strCan += String.Format("{0}{1}A--Alternator Current\r\n",
                        blanks,
                        ReadUnsignedByte(value, 1));
                    strCan += String.Format("{0}{1:0.00}V--Charging System Potential (Voltage)\r\n",
                        blanks,
                        0.05 * ReverseBytes(ReadUint16(value, 2)));
                    strCan += String.Format("{0}{1:0.00}V--Battery Potential / Power Input 1\r\n",
                        blanks,
                        0.05 * ReverseBytes(ReadUint16(value, 4)));
                    strCan += String.Format("{0}{1:0.00}V--Keyswitch Battery Potential\r\n",
                        blanks,
                        0.05 * ReverseBytes(ReadUint16(value, 6)));
                    break;
                case 65276://(0x00FEFC)(R) Dash Display
                    strCan += "(R)Dash Display\r\n";
                    strCan += String.Format("{0}{1}%--Washer Fluid Level\r\n",
                        blanks,
                        0.4 * ReadUnsignedByte(value, 0));
                    strCan += String.Format("{0}{1}%--Fuel Level 1\r\n",
                        blanks,
                        0.4 * ReadUnsignedByte(value, 1));
                    strCan += String.Format("{0}{1}kPa--Engine Fuel Filter Differential Pressure\r\n",
                        blanks,
                        2 * ReadUnsignedByte(value, 2));
                    strCan += String.Format("{0}{1:0.0}kPa--Engine Oil Filter Differential Pressure\r\n",
                        blanks,
                        0.5 * ReadUnsignedByte(value, 3));
                    strCan += String.Format("{0}{1:0.00}deg C--Cargo Ambient Temperature\r\n",
                        blanks,
                        -273 + 0.03125 * ReverseBytes(ReadUint16(value, 4)));
                    strCan += String.Format("{0}{1}%--Fuel Level 2\r\n",
                        blanks,
                        0.4 * ReadUnsignedByte(value, 6));
                    break;
                case 65226://(DM1)Active DTCs and lamp status information
                    strCan += "(DM1)Active DTCs and lamp status information\r\n";
                    strCan += J1939DtcsDecode(value);
                    break;
                case 65227://(DM2)Previously active DTCs and lamp status information
                    strCan += "(DM2)Previously active DTCs and lamp status information\r\n";
                    strCan += J1939DtcsDecode(value);
                    break;
                default:
                    strCan += "\r\n";
                    break;
            }
            OutputText(strCan);
        }

        string J1939DtcsDecode(byte[] value)
        {
            string str = "";
            if(value.Length < 7)
                return str;
            String[] LampStatus = {"OFF", "ON","Unknown", "Unknown"};

            str += "              MIL: ";
            str += LampStatus[(value[0] >> 6) & 0x03] + "\r\n";

            str += "              RSL: ";
            str += LampStatus[(value[0] >> 4) & 0x03] + "\r\n";

            str += "              AWL: ";
            str += LampStatus[(value[0] >> 2) & 0x03] + "\r\n";

            str += "              PL: ";
            str += LampStatus[value[0] & 0x03] + "\r\n";

            for (int i = 0; i < (value.Length - 2) / 4; i++)
            {
                str += String.Format("              DTC{0}:\r\n", i);
                UInt32 SPN = (UInt32)(value[2 + 4 * i + 2] >> 5);
                SPN = (SPN << 8) + value[2 + 4 * i + 1];
                SPN = (SPN << 8) + value[2 + 4 * i];
                Byte FMI = (Byte)(value[2 + 4 * i + 2] & 0x1F);
                Byte OC = (Byte)(value[2 + 4 * i + 3] & 0x7F);
                str += String.Format("                  SPN: {0}\r\n", SPN);
                str += String.Format("                  FMI: {0}\r\n", FMI);
                str += String.Format("                  OC: {0}\r\n", OC);
            }
            return str;
        }

        void J1708MidDecode(byte[] value)
        {
            string hex = "";
            for (int i = 1; i < value.Length; i++)
            {
                hex += String.Format("{0:X2} ", value[i]);
            }
            string strMID = String.Format("        MID{0}: {1}\r\n",
                            value[0],
                            hex);
            OutputText(strMID);
        }

        void J1587PidDecode(byte[] value, int pid)
        {
            string strPID;
            switch (pid)
            {
                case 84://Road speed
                    strPID = String.Format("        PID{0}: {1:0.000}km/h--Road speed\r\n",
                            pid,
                            (double)ReadUnsignedByte(value, 0) * 0.805);
                    break;
	            case 96://Fuel level
                    strPID = String.Format("        PID{0}: {1:0.0}%--Fuel level\r\n",
                            pid,
                            (double)ReadUnsignedByte(value, 0) * 0.5);
                    break;
	            case 110://Engine Coolant Temperature
                    strPID = String.Format("        PID{0}: {1}Fahrenheit--Engine Coolant Temperature\r\n",
                            pid,
                            ReadUnsignedByte(value, 0));
                    break;
	            case 190://Engine speed
                    strPID = String.Format("        PID{0}: {1:0.00}RPM--Engine speed\r\n",
                            pid,
                            (double)ReadUint16(value, 0) * 0.25);
                    break;
	            case 245://Total Vehicle Distance
                    strPID = String.Format("        PID{0}: {1:0.000}km--Total Vehicle Distance\r\n",
                            pid,
                            (double)ReadUint32(value, 0) * 0.161);
                    break;
                default:
                    string hex = "";
                    for (int i = 0; i < value.Length; i++)
                    {
                        hex += String.Format("{0:X2} ", value[i]);
                    }
                    strPID = String.Format("        PID{0}: {1}\r\n",
                            pid,
                            hex);
                    break;
            }
            OutputText(strPID);
        }

        string DataTxtAcknowledgement(byte[] data)
        {
            return String.Format("*TS01,ACK:{0:X4}#", GetCrc16Value(data, data.Length));
        }

        byte[] DataBinAcknowledgement(byte[] data)
        {
            UInt16 crcData = GetCrc16Value(data, data.Length);
            byte[] ackData = new byte[6];

            ackData[0] = ProtocolVersion;
            ackData[1] = AckFlag;
            ackData[2] = (byte)((crcData >> 8) & 0xFF);
            ackData[3] = (byte)(crcData & 0xFF);
            UInt16 crcFrame = GetCrc16Value(ackData, ackData.Length - 2);
            ackData[4] = (byte)((crcFrame >> 8) & 0xFF);
            ackData[5] = (byte)(crcFrame & 0xFF);

            return binDataPacket(ackData);
        }

        byte[] binDataPacket(byte[] data)
        {
            List<byte> packet = new List<byte>();

            packet.Add(binFlagChar);
            for (int i = 0; i < 6; i++)
            {
                if (data[i] == binFlagChar || data[i] == binEscapeChar)
                {
                    packet.Add(binEscapeChar);
                    packet.Add((byte)((data[i] ^ binEscapeChar) & 0xFF));
                }
                else
                {
                    packet.Add(data[i]);
                }
            }
            packet.Add(binFlagChar);
            return packet.ToArray();
        }

        UInt16 GetCrc16Value(byte[] dat, int length)
        {
            UInt16[] crc_ta={   0x0000, 0x1021, 0x2042, 0x3063, 0x4084, 0x50a5, 0x60c6, 0x70e7,
                                0x8108, 0x9129, 0xa14a, 0xb16b, 0xc18c, 0xd1ad, 0xe1ce, 0xf1ef,
                                0x1231, 0x0210, 0x3273, 0x2252, 0x52b5, 0x4294, 0x72f7, 0x62d6,
                                0x9339, 0x8318, 0xb37b, 0xa35a, 0xd3bd, 0xc39c, 0xf3ff, 0xe3de,
                                0x2462, 0x3443, 0x0420, 0x1401, 0x64e6, 0x74c7, 0x44a4, 0x5485,
                                0xa56a, 0xb54b, 0x8528, 0x9509, 0xe5ee, 0xf5cf, 0xc5ac, 0xd58d,
                                0x3653, 0x2672, 0x1611, 0x0630, 0x76d7, 0x66f6, 0x5695, 0x46b4,
                                0xb75b, 0xa77a, 0x9719, 0x8738, 0xf7df, 0xe7fe, 0xd79d, 0xc7bc,
                                0x48c4, 0x58e5, 0x6886, 0x78a7, 0x0840, 0x1861, 0x2802, 0x3823,
                                0xc9cc, 0xd9ed, 0xe98e, 0xf9af, 0x8948, 0x9969, 0xa90a, 0xb92b,
                                0x5af5, 0x4ad4, 0x7ab7, 0x6a96, 0x1a71, 0x0a50, 0x3a33, 0x2a12,
                                0xdbfd, 0xcbdc, 0xfbbf, 0xeb9e, 0x9b79, 0x8b58, 0xbb3b, 0xab1a,
                                0x6ca6, 0x7c87, 0x4ce4, 0x5cc5, 0x2c22, 0x3c03, 0x0c60, 0x1c41,
                                0xedae, 0xfd8f, 0xcdec, 0xddcd, 0xad2a, 0xbd0b, 0x8d68, 0x9d49,
                                0x7e97, 0x6eb6, 0x5ed5, 0x4ef4, 0x3e13, 0x2e32, 0x1e51, 0x0e70,
                                0xff9f, 0xefbe, 0xdfdd, 0xcffc, 0xbf1b, 0xaf3a, 0x9f59, 0x8f78,
                                0x9188, 0x81a9, 0xb1ca, 0xa1eb, 0xd10c, 0xc12d, 0xf14e, 0xe16f,
                                0x1080, 0x00a1, 0x30c2, 0x20e3, 0x5004, 0x4025, 0x7046, 0x6067,
                                0x83b9, 0x9398, 0xa3fb, 0xb3da, 0xc33d, 0xd31c, 0xe37f, 0xf35e,
                                0x02b1, 0x1290, 0x22f3, 0x32d2, 0x4235, 0x5214, 0x6277, 0x7256,
                                0xb5ea, 0xa5cb, 0x95a8, 0x8589, 0xf56e, 0xe54f, 0xd52c, 0xc50d,
                                0x34e2, 0x24c3, 0x14a0, 0x0481, 0x7466, 0x6447, 0x5424, 0x4405,
                                0xa7db, 0xb7fa, 0x8799, 0x97b8, 0xe75f, 0xf77e, 0xc71d, 0xd73c,
                                0x26d3, 0x36f2, 0x0691, 0x16b0, 0x6657, 0x7676, 0x4615, 0x5634,
                                0xd94c, 0xc96d, 0xf90e, 0xe92f, 0x99c8, 0x89e9, 0xb98a, 0xa9ab,
                                0x5844, 0x4865, 0x7806, 0x6827, 0x18c0, 0x08e1, 0x3882, 0x28a3,
                                0xcb7d, 0xdb5c, 0xeb3f, 0xfb1e, 0x8bf9, 0x9bd8, 0xabbb, 0xbb9a,
                                0x4a75, 0x5a54, 0x6a37, 0x7a16, 0x0af1, 0x1ad0, 0x2ab3, 0x3a92,
                                0xfd2e, 0xed0f, 0xdd6c, 0xcd4d, 0xbdaa, 0xad8b, 0x9de8, 0x8dc9,
                                0x7c26, 0x6c07, 0x5c64, 0x4c45, 0x3ca2, 0x2c83, 0x1ce0, 0x0cc1,
                                0xef1f, 0xff3e, 0xcf5d, 0xdf7c, 0xaf9b, 0xbfba, 0x8fd9, 0x9ff8,
                                0x6e17, 0x7e36, 0x4e55, 0x5e74, 0x2e93, 0x3eb2, 0x0ed1, 0x1ef0};

            UInt16 crc;
            byte da;

            crc=0;
            for(int i = 0; i < length; i ++)
            {
                da = (byte) (crc >> 8);
                crc <<= 8;
                crc ^= crc_ta[da ^ dat[i]];
            }
            return crc;
        }

        byte ReadUnsignedByte(byte[] dat, int pos)
        {
            if (pos + 1 > dat.Length)
                return 0;
            return dat[pos];
        }

        sbyte ReadSignedByte(byte[] dat, int pos)
        {
            if (pos + 1 > dat.Length)
                return 0;
            return (sbyte)dat[pos];
        }

        UInt32 ReadUint32(byte[] dat, int pos)
        {
            if (pos + 4 > dat.Length)
                return 0;
            UInt32 val = 0;
            for (int i = 0; i < 4; i++)
            {
                val = (val << 8) + dat[pos + i];
            }
            return val;
        }

        UInt32 ReadUint32(byte[] dat, int pos, bool reverse)
        {
            if (pos + 4 > dat.Length)
                return 0;
            UInt32 val = 0;
            for (int i = 0; i < 4; i++)
            {
                val = (val << 8) + dat[pos + i];
            }
            return val;
        }

        Int32 ReadInt32(byte[] dat, int pos)
        {
            return (Int32)ReadUint32(dat, pos);
        }

        UInt16 ReadUint16(byte[] dat, int pos)
        {
            if (pos + 2 > dat.Length)
                return 0;
            UInt16 val = 0;
            for (int i = 0; i < 2; i++)
            {
                val = (UInt16)((val << 8) + dat[pos + i]);
            }
            return val;
        }

        Int16 ReadInt16(byte[] dat, int pos)
        {
            return (Int16)ReadUint16(dat, pos);
        }

        UInt16 ReverseBytes(UInt16 value)
        {
            return (UInt16)((value & 0xFFU) << 8 | (value & 0xFF00U) >> 8);
        }

        UInt32 ReverseBytes(UInt32 value)
        {
            return (value & 0x000000FFU) << 24 | (value & 0x0000FF00U) << 8 |
                    (value & 0x00FF0000U) >> 8 | (value & 0xFF000000U) >> 24;
        }

        UInt64 ReverseBytes(UInt64 value)
        {
            return (value & 0x00000000000000FFUL) << 56 | (value & 0x000000000000FF00UL) << 40 |
                (value & 0x0000000000FF0000UL) << 24 | (value & 0x00000000FF000000UL) << 8 |
                (value & 0x000000FF00000000UL) >> 8 | (value & 0x0000FF0000000000UL) >> 24 |
                (value & 0x00FF000000000000UL) >> 40 | (value & 0xFF00000000000000UL) >> 56;
        }

        void OutputText(string str)
        {
            tempWrite.Write(str);
            tempWrite.Flush();
            tempFile.Flush();
        }
    }
}
