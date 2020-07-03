FROM ubuntu:16.04

RUN apt-get update && apt-get install -y nano wget git default-jdk
RUN mkdir minecraft && git config --global core.autocrlf input
RUN wget "https://hub.spigotmc.org//jenkins/job/BuildTools/lastSuccessfulBuild/artifact/target/BuildTools.jar" -O minecraft/BuildTools.jar
RUN java -Xmx1024M -jar minecraft/BuildTools.jar --rev latest
RUN apt-get purge -y --autoremove git
RUN echo "eula=true" > eula.txt && mkdir plugins

CMD java -Xms512m -Xmx1024m -jar spigot-*.jar nogui 
EXPOSE 25565
