namespace Ulbotech_Decoder
{
    partial class Form1
    {
        /// <summary>
        /// 必需的设计器变量。
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// 清理所有正在使用的资源。
        /// </summary>
        /// <param name="disposing">如果应释放托管资源，为 true；否则为 false。</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows 窗体设计器生成的代码

        /// <summary>
        /// 设计器支持所需的方法 - 不要
        /// 使用代码编辑器修改此方法的内容。
        /// </summary>
        private void InitializeComponent()
        {
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(Form1));
            this.btn_decode = new System.Windows.Forms.Button();
            this.btn_save = new System.Windows.Forms.Button();
            this.rtb_decode_info = new System.Windows.Forms.RichTextBox();
            this.panel1 = new System.Windows.Forms.Panel();
            this.progressBar1 = new System.Windows.Forms.ProgressBar();
            this.tabControl = new System.Windows.Forms.TabControl();
            this.tabPage1 = new System.Windows.Forms.TabPage();
            this.tabPage2 = new System.Windows.Forms.TabPage();
            this.txt_ack_txt_txtframe = new System.Windows.Forms.TextBox();
            this.txt_ack_txt_binframe = new System.Windows.Forms.TextBox();
            this.label3 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.btn_decode_txt = new System.Windows.Forms.Button();
            this.txt_text = new System.Windows.Forms.TextBox();
            this.tabPage3 = new System.Windows.Forms.TabPage();
            this.txt_ack_bin_txtframe = new System.Windows.Forms.TextBox();
            this.label4 = new System.Windows.Forms.Label();
            this.txt_ack_bin_binframe = new System.Windows.Forms.TextBox();
            this.label2 = new System.Windows.Forms.Label();
            this.btn_decode_bin = new System.Windows.Forms.Button();
            this.txt_binary = new System.Windows.Forms.TextBox();
            this.panel2 = new System.Windows.Forms.Panel();
            this.openFileDialog = new System.Windows.Forms.OpenFileDialog();
            this.saveFileDialog = new System.Windows.Forms.SaveFileDialog();
            this.panel1.SuspendLayout();
            this.tabControl.SuspendLayout();
            this.tabPage1.SuspendLayout();
            this.tabPage2.SuspendLayout();
            this.tabPage3.SuspendLayout();
            this.panel2.SuspendLayout();
            this.SuspendLayout();
            // 
            // btn_decode
            // 
            this.btn_decode.Location = new System.Drawing.Point(60, 305);
            this.btn_decode.Name = "btn_decode";
            this.btn_decode.Size = new System.Drawing.Size(229, 32);
            this.btn_decode.TabIndex = 1;
            this.btn_decode.Text = "Open data file to decode";
            this.btn_decode.UseVisualStyleBackColor = true;
            this.btn_decode.Click += new System.EventHandler(this.btn_decode_Click);
            // 
            // btn_save
            // 
            this.btn_save.Location = new System.Drawing.Point(64, 431);
            this.btn_save.Name = "btn_save";
            this.btn_save.Size = new System.Drawing.Size(229, 32);
            this.btn_save.TabIndex = 1;
            this.btn_save.Text = "Save decoded message";
            this.btn_save.UseVisualStyleBackColor = true;
            this.btn_save.Click += new System.EventHandler(this.btn_save_Click);
            // 
            // rtb_decode_info
            // 
            this.rtb_decode_info.Dock = System.Windows.Forms.DockStyle.Fill;
            this.rtb_decode_info.Location = new System.Drawing.Point(0, 0);
            this.rtb_decode_info.MinimumSize = new System.Drawing.Size(419, 422);
            this.rtb_decode_info.Name = "rtb_decode_info";
            this.rtb_decode_info.ReadOnly = true;
            this.rtb_decode_info.Size = new System.Drawing.Size(419, 522);
            this.rtb_decode_info.TabIndex = 2;
            this.rtb_decode_info.Text = "";
            // 
            // panel1
            // 
            this.panel1.Controls.Add(this.progressBar1);
            this.panel1.Controls.Add(this.tabControl);
            this.panel1.Controls.Add(this.btn_save);
            this.panel1.Dock = System.Windows.Forms.DockStyle.Left;
            this.panel1.Location = new System.Drawing.Point(0, 0);
            this.panel1.Name = "panel1";
            this.panel1.Size = new System.Drawing.Size(356, 522);
            this.panel1.TabIndex = 3;
            // 
            // progressBar1
            // 
            this.progressBar1.Location = new System.Drawing.Point(0, 469);
            this.progressBar1.Name = "progressBar1";
            this.progressBar1.Size = new System.Drawing.Size(356, 23);
            this.progressBar1.Style = System.Windows.Forms.ProgressBarStyle.Continuous;
            this.progressBar1.TabIndex = 3;
            // 
            // tabControl
            // 
            this.tabControl.Controls.Add(this.tabPage1);
            this.tabControl.Controls.Add(this.tabPage2);
            this.tabControl.Controls.Add(this.tabPage3);
            this.tabControl.Dock = System.Windows.Forms.DockStyle.Top;
            this.tabControl.Location = new System.Drawing.Point(0, 0);
            this.tabControl.Name = "tabControl";
            this.tabControl.SelectedIndex = 0;
            this.tabControl.Size = new System.Drawing.Size(356, 426);
            this.tabControl.TabIndex = 2;
            // 
            // tabPage1
            // 
            this.tabPage1.Controls.Add(this.btn_decode);
            this.tabPage1.Location = new System.Drawing.Point(4, 22);
            this.tabPage1.Name = "tabPage1";
            this.tabPage1.Padding = new System.Windows.Forms.Padding(3);
            this.tabPage1.Size = new System.Drawing.Size(348, 400);
            this.tabPage1.TabIndex = 0;
            this.tabPage1.Text = "File";
            this.tabPage1.UseVisualStyleBackColor = true;
            // 
            // tabPage2
            // 
            this.tabPage2.Controls.Add(this.txt_ack_txt_txtframe);
            this.tabPage2.Controls.Add(this.txt_ack_txt_binframe);
            this.tabPage2.Controls.Add(this.label3);
            this.tabPage2.Controls.Add(this.label1);
            this.tabPage2.Controls.Add(this.btn_decode_txt);
            this.tabPage2.Controls.Add(this.txt_text);
            this.tabPage2.Location = new System.Drawing.Point(4, 22);
            this.tabPage2.Name = "tabPage2";
            this.tabPage2.Padding = new System.Windows.Forms.Padding(3);
            this.tabPage2.Size = new System.Drawing.Size(348, 400);
            this.tabPage2.TabIndex = 1;
            this.tabPage2.Text = "Text";
            this.tabPage2.UseVisualStyleBackColor = true;
            // 
            // txt_ack_txt_txtframe
            // 
            this.txt_ack_txt_txtframe.Location = new System.Drawing.Point(101, 370);
            this.txt_ack_txt_txtframe.Name = "txt_ack_txt_txtframe";
            this.txt_ack_txt_txtframe.Size = new System.Drawing.Size(226, 21);
            this.txt_ack_txt_txtframe.TabIndex = 5;
            // 
            // txt_ack_txt_binframe
            // 
            this.txt_ack_txt_binframe.Location = new System.Drawing.Point(101, 344);
            this.txt_ack_txt_binframe.Name = "txt_ack_txt_binframe";
            this.txt_ack_txt_binframe.Size = new System.Drawing.Size(226, 21);
            this.txt_ack_txt_binframe.TabIndex = 5;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(6, 374);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(89, 12);
            this.label3.TabIndex = 4;
            this.label3.Text = "ACK frame(TXT)";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(6, 348);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(89, 12);
            this.label1.TabIndex = 4;
            this.label1.Text = "ACK frame(HEX)";
            // 
            // btn_decode_txt
            // 
            this.btn_decode_txt.Location = new System.Drawing.Point(60, 305);
            this.btn_decode_txt.Name = "btn_decode_txt";
            this.btn_decode_txt.Size = new System.Drawing.Size(229, 32);
            this.btn_decode_txt.TabIndex = 3;
            this.btn_decode_txt.Text = "Decode";
            this.btn_decode_txt.UseVisualStyleBackColor = true;
            this.btn_decode_txt.Click += new System.EventHandler(this.btn_decode_txt_Click);
            // 
            // txt_text
            // 
            this.txt_text.Location = new System.Drawing.Point(3, 3);
            this.txt_text.MaxLength = 4194303;
            this.txt_text.Multiline = true;
            this.txt_text.Name = "txt_text";
            this.txt_text.ScrollBars = System.Windows.Forms.ScrollBars.Vertical;
            this.txt_text.Size = new System.Drawing.Size(339, 290);
            this.txt_text.TabIndex = 0;
            // 
            // tabPage3
            // 
            this.tabPage3.Controls.Add(this.txt_ack_bin_txtframe);
            this.tabPage3.Controls.Add(this.label4);
            this.tabPage3.Controls.Add(this.txt_ack_bin_binframe);
            this.tabPage3.Controls.Add(this.label2);
            this.tabPage3.Controls.Add(this.btn_decode_bin);
            this.tabPage3.Controls.Add(this.txt_binary);
            this.tabPage3.Location = new System.Drawing.Point(4, 22);
            this.tabPage3.Name = "tabPage3";
            this.tabPage3.Size = new System.Drawing.Size(348, 400);
            this.tabPage3.TabIndex = 2;
            this.tabPage3.Text = "Binary";
            this.tabPage3.UseVisualStyleBackColor = true;
            // 
            // txt_ack_bin_txtframe
            // 
            this.txt_ack_bin_txtframe.Location = new System.Drawing.Point(101, 370);
            this.txt_ack_bin_txtframe.Name = "txt_ack_bin_txtframe";
            this.txt_ack_bin_txtframe.Size = new System.Drawing.Size(226, 21);
            this.txt_ack_bin_txtframe.TabIndex = 4;
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(6, 374);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(89, 12);
            this.label4.TabIndex = 3;
            this.label4.Text = "ACK frame(TXT)";
            // 
            // txt_ack_bin_binframe
            // 
            this.txt_ack_bin_binframe.Location = new System.Drawing.Point(101, 344);
            this.txt_ack_bin_binframe.Name = "txt_ack_bin_binframe";
            this.txt_ack_bin_binframe.Size = new System.Drawing.Size(226, 21);
            this.txt_ack_bin_binframe.TabIndex = 4;
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(6, 348);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(89, 12);
            this.label2.TabIndex = 3;
            this.label2.Text = "ACK frame(HEX)";
            // 
            // btn_decode_bin
            // 
            this.btn_decode_bin.Location = new System.Drawing.Point(60, 305);
            this.btn_decode_bin.Name = "btn_decode_bin";
            this.btn_decode_bin.Size = new System.Drawing.Size(229, 32);
            this.btn_decode_bin.TabIndex = 2;
            this.btn_decode_bin.Text = "Decode";
            this.btn_decode_bin.UseVisualStyleBackColor = true;
            this.btn_decode_bin.Click += new System.EventHandler(this.btn_decode_bin_Click);
            // 
            // txt_binary
            // 
            this.txt_binary.Location = new System.Drawing.Point(3, 3);
            this.txt_binary.MaxLength = 4194303;
            this.txt_binary.Multiline = true;
            this.txt_binary.Name = "txt_binary";
            this.txt_binary.ScrollBars = System.Windows.Forms.ScrollBars.Vertical;
            this.txt_binary.Size = new System.Drawing.Size(339, 290);
            this.txt_binary.TabIndex = 1;
            // 
            // panel2
            // 
            this.panel2.Controls.Add(this.rtb_decode_info);
            this.panel2.Dock = System.Windows.Forms.DockStyle.Fill;
            this.panel2.Location = new System.Drawing.Point(356, 0);
            this.panel2.Name = "panel2";
            this.panel2.Size = new System.Drawing.Size(419, 522);
            this.panel2.TabIndex = 4;
            // 
            // openFileDialog
            // 
            this.openFileDialog.Filter = "(*.txt,*.bin)|*.txt;*.bin";
            // 
            // saveFileDialog
            // 
            this.saveFileDialog.Filter = "(*.txt,)|*.txt";
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 12F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(775, 522);
            this.Controls.Add(this.panel2);
            this.Controls.Add(this.panel1);
            this.Icon = ((System.Drawing.Icon)(resources.GetObject("$this.Icon")));
            this.MinimumSize = new System.Drawing.Size(547, 327);
            this.Name = "Form1";
            this.Text = "Ulbotech Data Decoder";
            this.WindowState = System.Windows.Forms.FormWindowState.Maximized;
            this.panel1.ResumeLayout(false);
            this.tabControl.ResumeLayout(false);
            this.tabPage1.ResumeLayout(false);
            this.tabPage2.ResumeLayout(false);
            this.tabPage2.PerformLayout();
            this.tabPage3.ResumeLayout(false);
            this.tabPage3.PerformLayout();
            this.panel2.ResumeLayout(false);
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Button btn_decode;
        private System.Windows.Forms.Button btn_save;
        private System.Windows.Forms.RichTextBox rtb_decode_info;
        private System.Windows.Forms.Panel panel1;
        private System.Windows.Forms.Panel panel2;
        private System.Windows.Forms.OpenFileDialog openFileDialog;
        private System.Windows.Forms.SaveFileDialog saveFileDialog;
        private System.Windows.Forms.TabControl tabControl;
        private System.Windows.Forms.TabPage tabPage1;
        private System.Windows.Forms.TabPage tabPage2;
        private System.Windows.Forms.TabPage tabPage3;
        private System.Windows.Forms.TextBox txt_text;
        private System.Windows.Forms.Button btn_decode_txt;
        private System.Windows.Forms.Button btn_decode_bin;
        private System.Windows.Forms.TextBox txt_binary;
        private System.Windows.Forms.ProgressBar progressBar1;
        private System.Windows.Forms.TextBox txt_ack_txt_binframe;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.TextBox txt_ack_bin_binframe;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.TextBox txt_ack_txt_txtframe;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.TextBox txt_ack_bin_txtframe;
        private System.Windows.Forms.Label label4;
    }
}

