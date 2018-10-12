# -*- coding: utf-8 -*-
import subprocess

pinNumber = 0
sensorModel = 'DHT11'

proc = subprocess.Popen(['dht-sensor ' + str(pinNumber) + ' ' + sensorModel], stdout=subprocess.PIPE, shell=True)
(out, err) = proc.communicate()

sensor_data = out.split('\n')
print(out,err)
humidity = sensor_data[0]
temperature = sensor_data[1]

# print "Humidity:"
print (str(humidity) + "%")

# print "Temperature:"
print (str(temperature) + "°C")