FROM debian

RUN apt-get update -y && apt-get dist-upgrade -y
RUN apt-get install python-setuptools python3 git python-pip python-dev python3-dev python3-pip python3-scipy build-essential libssl-dev libffi-dev libxml2-dev libxslt1-dev zlib1g-dev -y
RUN python3 -m pip install -U instabot
   # Error conocido: https://github.com/instagrambot/instabot/issues/1293#issuecomment-610935629
RUN git clone https://github.com/instagrambot/instabot.git

WORKDIR /instabot
CMD sleep infinity
