# email_tracker

## Description:

The email tracking system (name to change) is a simple PHP application that tracks emails using a MySQL database and a small image added to the end of the email message. When loaded, the email sends a request to the remote address of the image, triggering a function that updates the information stored in the database for that email.  All emails are tracked individually by a random code generated. 

## Installation:

### Part 1: File Extraction and Database Setup
1. Unzip the file to your web folder. 
2. Make a copy of the **example-conn.php** file and rename it **conn.php**. 
3. Change the connection information for your server. 
4. Navigate to the location of the folder the files are extracted to. 
5. The database will set itself up upon loading the page. 

### Part 2:  SendMail setup
1. Change the SMTP settings in **functions.php** to those of your SMTP server. 
   * **GMAIL Settings Example**
   * Outgoing Mail (SMTP) Server: smtp.gmail.com
   * Use Authentication: Yes
   * Use Secure Connection: Yes (this can be TLS or SSL depending on your mail client)
   * Username: GMail account (email@gmail.com)
   * Password: GMail password
   * Port: 465 or 587
2. Modify the HTML in the **$message** variable to suite your needs. (**note:** Text emails are also an option.)
   
## Usage

## License 
MIT License

Copyright (c) [2019] [William Kroes]

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
