import datetime
import time,json
import onionGpio # See Library: https://github.com/OnionIoT/onion-gpio
import threading
from losantmqtt import Device
import paho.mqtt.client as mqtt #import the client1

ledPin = 0 # GPIO 0
buttonPin = 1 # GPIO 1
ledPin1 = 3
lightStatus = 1
lightStatus1 = 0
st = ""
led = onionGpio.OnionGpio(ledPin)
led1 = onionGpio.OnionGpio(ledPin1)
led.setOutputDirection(0) # make LED output and init to 0
led1.setOutputDirection(0)
led1.setValue(1)
led.setValue(1)
broker_address="iot.eclipse.org"
port=1883
print("creating new instance")
def on_publish(client,userdata,result):             #create function for callback
    print("data published \n")
    pass
#client1= paho.Client("control1")  
client = mqtt.Client("akrdClient1")
client.on_publish = on_publish
print("connecting to client")
client.connect(broker_address,port)  
 
def timertoggle(st,et):
	while 1:
		ct = datetime.datetime.now()
		ctt =str(ct.hour) +" "+str(ct.minute)+" "+str(ct.second)
		print(ctt,st,et)
		print("while")
		time.sleep(1)
		if(ctt == st):
			ct = datetime.datetime.now()
			ctt =str(ct.hour) +" "+str(ct.minute)+" "+str(ct.second)
			print(ctt,st,et)
			print("if")
			time.sleep(1)
			while(ctt != et):
				ct = datetime.datetime.now()
				ctt =str(ct.hour) +" "+str(ct.minute)+" "+str(ct.second)
				print(ctt,st,et)
				print("loop",lightStatus1)
				led.setValue(0)
				time.sleep(1)
				if lightStatus1 == 1:
					led.setValue(1)
					break
			led.setValue(1)
# Construct device
device = Device("5b1e42dc96c2ca000681d529", "69cd072f-8e6a-4636-84d9-35b4835695d0", "909d124b7d435ec6a220267336c1de670498b6d27bb5515a9c0ce6f3a9a657ec")

# Called when a Losant Device Command is received.
def on_command(device, command):
    global lightStatus
    global lightStatus1
    print("Command received.")
    
    #data = json.dumps({'state':lightStatus,'timestamp':time.time()})        # json is a recommended data format
    #client.publish("sigmaway/akrd/db2"
    #                   "",data)
    #client.publish(topic="sigmaway", payload=data,qos=0,retain=False)
    client.on_publish = on_publish
    print(command["name"])
    if command["name"] == "togglelight":
		print("Light Toggle")
		print(lightStatus1)
		lightStatus = int(not lightStatus)
		if lightStatus == 1:
			lightStatus1 = 1
		else:
			lightStatus1 = 0
		led1.setValue(lightStatus)
		data = json.dumps({'state':int(not lightStatus),'timestamp':str(time.strftime('%Y-%m-%d %H:%M:%S', time.localtime(time.time())))})        # json is a recommended data format
		print("data : ",data)
		print("Publishing message to topic","sigmaway/losant")
		client.publish(topic="sigmaway/losant", payload=data,qos=1,retain=False)
    elif command["name"] == "toggle":
    	st = str(command["payload"]["st"]) 
    	et = str(command["payload"]["et"])
    	t1 = threading.Thread(target=timertoggle,args=(st,et))
    	t1.start()
    	


# Listen for commands
device.add_event_observer("command", on_command)

# Connect to Losant.
device.connect(blocking=False)
print("Here we go! Press CTRL+C to exit")
try:
    while 1:
        device.loop()
        if device.is_connected():
        	print("Connected")
except KeyboardInterrupt: # If CTRL+C is pressed, exit cleanly:
    led._freeGpio()
    led1._freeGpio()
    button._freeGpio()# cleanup all GPIO
    client.loop_stop() #stop the loop
"""
# broker_address="192.168.1.184"
broker_address="iot.eclipse.org"
print("creating new instance")
client = mqtt.Client("akrdClient") # create new instance
try:
    print("connecting to broker")
    client.connect(broker_address)  # connect to broker
    client.loop_start()             # start the loop
    data = json.dumps({'state':'rana','timestamp':time.time()})        # json is a recommended data format
    print("Publishing message to topic","sigmaway/akrd/db2")
    client.publish("sigmaway/akrd/db2"
                       "",data)
except Exception as e:
    print("Error occured : ", e)

client.loop_stop() #stop the loop
"""