#/usr/bin/env sh

# install libwebp
wget http://downloads.webmproject.org/releases/webp/libwebp-0.5.1.tar.gz
tar xvzf libwebp-0.5.1.tar.gz
cd libwebp-0.5.1
./configure
make && make install

# install imagick
pear config-set preferred_state beta
pecl channel-update pecl.php.net
yes | pecl install imagick