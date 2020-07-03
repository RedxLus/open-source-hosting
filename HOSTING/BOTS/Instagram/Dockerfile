FROM debian

RUN apt-get update -y && apt-get dist-upgrade -y
RUN apt-get install python-setuptools python3 git python-pip python-dev python3-dev python3-pip python3-scipy \
    build-essential libssl-dev libffi-dev libxml2-dev libxslt1-dev zlib1g-dev \
    git wget python3-numpy python3-scipy netpbm \
    python3-pyqt5 ghostscript libffi-dev libjpeg-turbo-progs \
    python3-setuptools virtualenv \
    python3-dev cmake \
    libtiff5-dev libjpeg62-turbo-dev libopenjp2-7-dev zlib1g-dev \
    libfreetype6-dev liblcms2-dev libwebp-dev tcl8.6-dev tk8.6-dev \
    python3-tk \
    libharfbuzz-dev libfribidi-dev -y
RUN python3 -m pip install -U instabot
   # Error conocido: https://github.com/instagrambot/instabot/issues/1293#issuecomment-610935629
RUN git clone https://github.com/instagrambot/instabot.git

WORKDIR /instabot
CMD sleep infinity
