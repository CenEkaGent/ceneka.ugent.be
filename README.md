# CenEka Site

A completely redesigned website for CenEka build from the ground up

## Get started

### Install PHP on Windows
1. Enable Bash on Ubuntu on Windows `https://msdn.microsoft.com/en-us/commandline/wsl/install_guide`
2. Open Bash on Ubuntu on Windows.
3. Run following commands
```
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install php7.1
```

### Install PHP on Ubuntu
1. Open terminal
2. Run
```
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install php7.1
```

### Install PHP on macOS
1. Open terminal
2. Install PHP 7.1 via Liip's php-osx tool:
```
curl -s https://php-osx.liip.ch/install.sh | bash -s 7.1
```
3. Add following line to the end of `~/.bash_profile`: `export PATH=/usr/local/php5/bin:$PATH`.
4. Restart the computer or run `source ~/.bash_profile`.

### Run code
1. Clone the repo using SSH (recommended): `git clone git@github.com:CenEkaGent/ceneka.ugent.be.git` or using HTTPS: `git clone https://github.com/CenEkaGent/ceneka.ugent.be.git`.
2. `cd ceneka.ugent.be`
3. Run the php server on that location by running `php -S localhost:8080`
4. Access the site from your browser at `http://localhost:8080/`

## Visual Studio Code
When developping with VSCode, following packages are recommended:
- Beautify - HookyQR
- Material Icon Theme - Philipp Kief
- PHP Debug - Felix Becker
- PHP IntelliSense - Felix Becker
- PHP IntelliSense Crane - Hvy Industries

## Licence
This project is licensed under the terms of the MIT license. Read the licence in the [licence file](LICENSE.md).
