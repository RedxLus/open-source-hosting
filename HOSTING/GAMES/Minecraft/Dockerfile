FROM ubuntu:18.04

RUN apt-get update && apt-get install -y nano wget git default-jdk
RUN git config --global core.autocrlf input && mkdir /minecraft

RUN wget "https://hub.spigotmc.org//jenkins/job/BuildTools/lastSuccessfulBuild/artifact/target/BuildTools.jar" -O minecraft/BuildTools.jar
RUN cd /minecraft && java -Xmx2G -jar /minecraft/BuildTools.jar --rev latest

RUN echo "eula=true" > /minecraft/eula.txt 
RUN mkdir /minecraft/plugins

WORKDIR /minecraft
CMD java -Xms512m -Xmx2G -jar spigot-*.jar nogui 
EXPOSE 25565
