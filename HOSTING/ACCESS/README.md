How to use:
1. Execute in the shell of the cluster: ```kubectl apply -f GCLOUD.yaml```
2. Wait like 3 minutes more less. Check the Pod is deploy: ```kubectl get pods -l app=gcloud```
3. Check the IP: ```kubectl get svc```
4. In your machine, access to the pod with SSH: ```ssh root@-IP OF LAST CHECK-``` and the password by default is: ```THEPASSWORDYOUCREATED```
