# Import all the libraries we need to run
import sys
import RPi.GPIO as GPIO
import os
from time import sleep
import Adafruit_DHT
import urllib2
DEBUG = 1
# Setup the pins we are connect to
RCpin = 24
DHTpin = 23
pir=25
GPIO.setwarnings(False) 
GPIO.setmode(GPIO.BCM)
GPIO.setup(RCpin, GPIO.IN, pull_up_down=GPIO.PUD_DOWN)
GPIO.setup(pir, GPIO.IN) #PIR
GPIO.setup(26, GPIO.OUT) #BUzzer




#Setup our API and delay

myDelay = 5 #how many seconds between posting data

def getSensorData():
    RHW, TW = Adafruit_DHT.read_retry(Adafruit_DHT.DHT11, DHTpin)
    
    #Convert from Celius to Farenheit
    TWF = 9/5*TW+32
   
    # return dict
    return (str(RHW), str(TW),str(TWF))

def RCtime(RCpin):
    LT = 0
    
    if (GPIO.input(RCpin) == True):
        LT += 1
    return (str(LT))

def presence(pir):
   a=0
   
   if (GPIO.input(pir)==True):
      a += 1
   return(str(a))

def main():

   print 'starting...'

   baseURL = 'http://rohitkumarz547.000webhostapp.com/esppost.php?'
    #baseURL = 'https://api.thingspeak.com/update?api_key=%s' % myAPI
   print baseURL

   while True:
      try:
         RHW, TW, TWF = getSensorData()
         LT = RCtime(RCpin)
         a= presence(pir)
         f = urllib2.urlopen(baseURL + 
                                "&field1=%s&field2=%s&field3=%s" % (TW, TWF, RHW)+
                                "&field4=%s" % (LT)+"&field5=%s" % (a))
         print f.read()
         print TW + " " + TWF+ " " + RHW + " " + LT+ " " + a
         f.close()


         sleep(int(myDelay))
      except:
         print 'exiting.'
         break

# call main
if __name__ == '__main__':
    main()

