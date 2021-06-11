#!/bin/bash
disk=$1
userid=$2
cpu=$3
i=$4


 if [ -e /var/www/html/project2/boot/"$userid"-"$i".qcow2 ]; then

\cp -f /var/www/html/project2/boot/worker-"$disk"G.qcow2 /var/www/html/project2/boot/"$userid"-"$i"-"$i".qcow2
chmod 777 /var/www/html/project2/boot/"$userid"-"$i"-"$i".qcow2
virt-install --name worker-"$userid"-"$i"-"$i" --vcpus "$cpu" --ram 1024 --disk path=/var/www/html/project2/boot/"$userid"-"$i"-"$i".qcow2 --network network:default --graphics none --serial pty --console pty --noautoconsole --import
~

else
\cp -f /var/www/html/project2/boot/worker-"$disk"G.qcow2 /var/www/html/project2/boot/"$userid"-"$i".qcow2
chmod 777 /var/www/html/project2/boot/"$userid"-"$i".qcow2
virt-install --name worker-"$userid"-"$i" --vcpus "$cpu" --ram 1024 --disk path=/var/www/html/project2/boot/"$userid"-"$i".qcow2 --network network:default --graphics none --serial pty --console pty --noautoconsole --import
fi
