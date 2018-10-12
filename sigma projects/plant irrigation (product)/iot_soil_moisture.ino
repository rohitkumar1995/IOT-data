#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <DNSServer.h>
#include <ESP8266WebServer.h>
#include <WiFiManager.h>  

int motor= D1;
const int sensor_pin = A0;  /* Connect Soil moisture analog sensor pin to A0 of NodeMCU */
int motor_status1;
float moisture_percentage;

void setup() {
  Serial.begin(115200); /* Define baud rate for serial communication */
  pinMode(motor, OUTPUT);
  WiFi.disconnect(true);
  WiFiManager wifiManager;
  wifiManager.Sigmaway("Smart_Strip");
  Serial.println("connected...yeey :)");
 
}

void moisture()
{
  
  moisture_percentage = ( 100.00 - ( (analogRead(sensor_pin)/1023.00) * 100.00 ) );
  Serial.print("Soil Moisture(in Percentage) = ");
  Serial.print(moisture_percentage);
  Serial.println("%");

  delay(1000);
}
void send_data()
{
      HTTPClient http;
      http.begin("http://moisturewater.000webhostapp.com/insert_level.php?did=plant2&sid=1&level="+String(moisture_percentage));
              //GET method
      http.GET();
      http.end();
  
}
void receive_data()
{
     HTTPClient http;
     http.begin("http://moisturewater.000webhostapp.com/motor_status3.php?did=plant2&sid=1");  //Specify request destination
     int httpCode = http.GET();                                                                  //Send the request
     if (httpCode > 0) { //Check the returning code
      String payload = http.getString();   //Get the request response payload
      Serial.println(payload); 
      motor_status1=payload.toInt();
      Serial.print("Database Status=");
      Serial.println(motor_status1); 
     }
     http.end();
}
void loop() {
 

moisture();

if (WiFi.status() == WL_CONNECTED) { 

 send_data();
 receive_data();
 }
  if(motor_status1==1)
  {
    digitalWrite(motor,HIGH);
    Serial.println("Motor_ON");
  }

  else if(motor_status1==0)
  {
    digitalWrite(motor,LOW);
    Serial.println("Motor_OFF");
  }


  
}
