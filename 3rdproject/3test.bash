
#!/bin/bash

port=$3
rep=$2
userid=$1

mkdir $userid/
cp docker-compose.yml $userid/docker-compose.yml
sed -i 's/DATABASE: name/DATABASE: '"$userid"'/g' $userid/docker-compose.yml
sed -i 's/USER: name/USER: '"$userid"'/g' $userid/docker-compose.yml
sed -i 's/8001:80/'"$port"':80/g' $userid/docker-compose.yml
sed -i 's/NAME: name/NAME: '"$userid"'/g' $userid/docker-compose.yml
docker-compose -f $userid/docker-compose.yml up -d
