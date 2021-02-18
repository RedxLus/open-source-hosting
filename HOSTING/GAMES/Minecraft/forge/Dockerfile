FROM ubuntu:18.04

RUN apt-get update && apt-get install -y nano wget default-jdk
RUN mkdir minecraft

RUN wget "https://files.minecraftforge.net/maven/net/minecraftforge/forge/1.12.2-14.23.5.2854/forge-1.12.2-14.23.5.2854-installer.jar" -O minecraft/forge-1.12.2-14.23.5.2854-installer.jar
RUN java -Xmx2G -jar minecraft/forge-1.12.2-14.23.5.2854-installer.jar --installServer

RUN echo "eula=true" > eula.txt

RUN mkdir mods && cd mods && wget -O Pixelmon-1.12.2-8.1.2.jar https://dl.reforged.gg/33trlT6

CMD java -Xms3G -Xmx3G -XX:+UseG1GC -XX:+UnlockExperimentalVMOptions -XX:MaxGCPauseMillis=100 -XX:+DisableExplicitGC -XX:TargetSurvivorRatio=90 -XX:G1NewSizePercent=50 -XX:G1MaxNewSizePercent=80 -XX:G1MixedGCLiveThresholdPercent=50 -XX:+AlwaysPreTouch -jar minecraft_server.1.12.2.jar nogui
EXPOSE 25565
