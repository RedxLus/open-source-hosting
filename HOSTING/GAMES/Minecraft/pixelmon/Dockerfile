FROM ubuntu:18.04

RUN apt-get update && apt-get install -y nano wget git openjdk-8-jre
RUN mkdir /minecraft

RUN wget "https://files.minecraftforge.net/maven/net/minecraftforge/forge/1.12.2-14.23.5.2838/forge-1.12.2-14.23.5.2838-installer.jar" -O /minecraft/minecraft-forge-installer.jar
RUN cd /minecraft && java -Xmx2G -jar /minecraft/minecraft-forge-installer.jar --installServer

RUN echo "eula=true" > /minecraft/eula.txt

RUN mv /minecraft/forge-1.12.2-14.23.5.2838-universal.jar /minecraft/minecraft-forge.jar

RUN mkdir /minecraft/mods \
  && mkdir /minecraft/mods-available \
  && wget "https://dl.reforged.gg/33trlT6" -O /minecraft/mods/Pixelmon.jar  \
  && wget "https://media.forgecdn.net/files/2678/374/extrautils2-1.12-1.9.9.jar" -O /minecraft/mods-available/extrautils2.jar \
  && wget "https://edge.forgecdn.net/files/2940/914/refinedstorage-1.6.16.jar" -O /minecraft/mods-available/refinedstorage.jar \
  && wget "https://pixelmonmod.com/mirror/sidemods/PixelmonExtras/2.5.11/PixelExtras-1.12.2-2.5.11-universal.jar" -O /minecraft/mods-available/PixelExtras.jar \
  && wget "https://edge.forgecdn.net/files/3043/174/jei_1.12.2-4.16.1.302.jar" -O /minecraft/mods-available/jei.jar 

WORKDIR /minecraft
CMD java -Xms512m -Xmx2G -jar minecraft-forge.jar nogui
EXPOSE 25565
