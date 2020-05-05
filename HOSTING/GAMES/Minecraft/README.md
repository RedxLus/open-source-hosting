How to use:
1. Execute in the shell of the cluster: ```kubectl apply -f MINECRAFT-SERVER.yaml```
2. Wait like 10 minutes more less. Check the Pod is deploy: ```kubectl get pods -l app=minecraft``` and check is started: ```kubectl logs -l app=minecraft```
3. Check the IP: ```kubectl get svc```
4. In your machine, access to the launcher of game Minecraft.
5. Press in multiplayer.
6. Press add server.
7. Set the server name and the IP.
