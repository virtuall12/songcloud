#!/bin/bash

port=$3
rep=$2
userid=$1

cp nginxdp.yaml $userid-nginx.yaml
sed -i 's/name: name/name: '"$userid"'/g' $userid-nginx.yaml
sed -i 's/app: name/app: '"$userid"'/g' $userid-nginx.yaml
sed -i 's/Name: name/Name: '"$userid"'/g' $userid-nginx.yaml
sed -i 's/replicas: number/replicas: '"$rep"'/g' $userid-nginx.yaml
sed -i 's/nodePort: 30001/nodePort: '"$port"'/g' $userid-nginx.yaml
kubectl apply -f $userid-nginx.yaml
