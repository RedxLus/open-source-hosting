FROM ubuntu:20.04

RUN apt-get update && apt-get install -y nano wget git apt-transport-https gnupg

RUN wget https://adoptopenjdk.jfrog.io/adoptopenjdk/api/gpg/key/public
RUN gpg --no-default-keyring --keyring ./adoptopenjdk-keyring.gpg --import public
RUN gpg --no-default-keyring --keyring ./adoptopenjdk-keyring.gpg --export --output adoptopenjdk-archive-keyring.gpg 
RUN mv adoptopenjdk-archive-keyring.gpg /usr/share/keyrings 
RUN echo "deb [signed-by=/usr/share/keyrings/adoptopenjdk-archive-keyring.gpg] https://adoptopenjdk.jfrog.io/adoptopenjdk/deb focal main" | tee /etc/apt/sources.list.d/adoptopenjdk.list
RUN apt-get update && apt-get install -y adoptopenjdk-16-openj9

RUN git config --global core.autocrlf input && mkdir /minecraft

RUN wget "https://hub.spigotmc.org//jenkins/job/BuildTools/lastSuccessfulBuild/artifact/target/BuildTools.jar" -O /minecraft/BuildTools.jar
RUN cd /minecraft && java -Xmx2G -jar /minecraft/BuildTools.jar --rev latest

RUN echo "eula=true" > /minecraft/eula.txt 
RUN mkdir /minecraft/plugins

WORKDIR /minecraft
CMD java -Xms512m -Xmx2G -jar spigot-*.jar nogui 
EXPOSE 25565
