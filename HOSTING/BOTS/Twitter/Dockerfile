FROM python:3
RUN mkdir /Twitter-Follow-and-Unfollow-Bot
RUN cd /Twitter-Follow-and-Unfollow-Bot && git clone https://github.com/yousefissa/Twitter-Follow-and-Unfollow-Bot.git
RUN pip install tweepy
ADD . /Twitter-Follow-and-Unfollow-Bot

WORKDIR /Twitter-Follow-and-Unfollow-Bot
CMD sleep infinity
