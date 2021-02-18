FROM ubuntu:18.04

RUN apt-get update && apt-get install -y nano wget default-jdk
RUN mkdir minecraft

RUN wget "https://files.minecraftforge.net/maven/net/minecraftforge/forge/1.12.2-14.23.5.2854/forge-1.12.2-14.23.5.2854-installer.jar" -O minecraft/forge-1.12.2-14.23.5.2854-installer.jar
RUN java -Xmx4G -jar minecraft/forge-1.12.2-14.23.5.2854-installer.jar --installServer

RUN echo "eula=true" > eula.txt

CMD java -Xms512m -Xmx2G -jar minecraft_server.1.12.2.jar nogui
EXPOSE 25565
