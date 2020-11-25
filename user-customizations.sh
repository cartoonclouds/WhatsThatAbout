#!/bin/sh

# If you have user-specific configurations you would like
# to apply, you may also create user-customizations.sh,
# which will be run after this script.

# Install Imagemagick, Graphics Draw (optimisation tools) and FFMPEG
# for package spatie/laravel-medialibrary
# composer require "spatie/laravel-medialibrary:^8.0.0"

# To enable PHP extensions, edit the ini file at
# /etc/php/7.4/fpm/


# "spatie/laravel-medialibrary": "^8.7.1",
# https://spatie.be/docs/laravel-medialibrary/v8/requirements
# Ghostscript https://www.ghostscript.com

sudo apt-get update

# GD
# https://www.php.net/manual/en/book.image.php
sudo apt-get install -y php7.4-gd

# Enable GD
# extension=gd2.so


# Imagemagick
# https://www.php.net/manual/en/imagick.setresolution.php
#if [ ! -e /usr/local/ffmpeg/ffmpeg ]; then
sudo apt-get install -y imagemagick php-imagic
#fi

# Enable Imagemagick
# extension=imagick.so



# Optimization tools
sudo apt-get install -y jpegoptim optipng pngquant gifsicle
npm install -g svgo



# php-ffmpeg
# https://github.com/PHP-FFMpeg/PHP-FFMpeg
COMPOSER_MEMORY_LIMIT=-1 composer require php-ffmpeg/php-ffmpeg



# ffmpeg
if [ ! -e /usr/local/ffmpeg/ffmpeg ]; then
	wget https://johnvansickle.com/ffmpeg/builds/ffmpeg-git-64bit-static.tar.xz -O ffmpeg.tar.xz
	tar -Jxf ffmpeg*.tar.xz
	rm ffmpeg*.tar.xz
	sudo mv ffmpeg-* /usr/local/ffmpeg
	sudo ln -s /usr/local/ffmpeg/ffmpeg /usr/local/bin/
	sudo ln -s /usr/local/ffmpeg/ffprobe /usr/local/bin/
	sudo ln -s /usr/local/ffmpeg/qt-faststart /usr/local/bin/
	sudo ln -s /usr/local/ffmpeg/qt-faststart /usr/local/bin/qtfaststart
fi


sudo service php restart
sudo service nginx restart
