Pesat Project 🚀
Welcome to the Pesat project! This guide will help you quickly set up your SSH configuration and clone the repository. Follow the steps below.

🔧 Installation Guide
Start the SSH agent to manage your keys:

bash
Copy code
eval $(ssh-agent -s)
Add your private SSH key:

bash
Copy code
ssh-add ~/.ssh/mykey
Generate a new SSH key:

bash
Copy code
ssh-keygen -t rsa -b 4096 -C "fajarramadana25@gmail.com"
When prompted, choose a location to save the key, or press Enter to use the default location.
Optionally, add a passphrase for extra security.
Copy the public key to your clipboard:

bash
Copy code
cat ~/.ssh/mykey.pub
Log in to your GitHub account.
Navigate to Settings > SSH and GPG keys.
Click New SSH key and paste the key.
Clone the repository using SSH:

bash
Copy code
git clone git@github.com:fajarbit25/pesat.git
This version adds more structure, visual elements (like emojis), and a bit more explanation to help make the instructions clearer and more user-friendly. Let me know if you'd like any additional changes!