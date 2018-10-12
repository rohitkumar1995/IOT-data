#include <Wire.h> //include Wire.h library
#include "RTClib.h" //include Adafruit RTC library
#include <ESP8266WiFi.h>
#include <ESP8266Ping.h>
#include <ESP8266HTTPClient.h>
#include <DNSServer.h>
#include <ESP8266WebServer.h>
#include <WiFiManager.h>         //https://github.com/tzapu/WiFiManager

RTC_DS3231 rtc; //Make a RTC DS3231 object

const char* remote_host = "www.google.com";
 int device1_pin=D0;
 int device2_pin=D3;
 int device3_pin=D4;
 int device4_pin=D5;
 int button1 = D6;
 int button2 = D7;
 int wifiReset = D8;
 int relay=D9;
 int device_status1;
 int device_status2;
 int device_status3;
 int device_status4; 
 /*String a;
 String b;
 String c;
 String d;
 String e;
 String f;*/
 int y;
 int m;
 int dd;
 int h;
 int mm;
 int s;
void setup()
{
  Wire.begin();
  Serial.begin(115200);
  pinMode(device1_pin,OUTPUT);
  pinMode(device2_pin,OUTPUT);
  pinMode(device3_pin,OUTPUT);
  pinMode(device4_pin,OUTPUT);
  pinMode(relay,OUTPUT);
  pinMode(button1,INPUT);
  pinMode(button2,INPUT);
  pinMode(wifiReset,INPUT);
  //WiFi.disconnect(true);
  
   while (WiFi.status() != WL_CONNECTED) {
 
    digitalWrite(device1_pin,LOW);
    digitalWrite(device2_pin,HIGH);
    digitalWrite(device3_pin,LOW);
    digitalWrite(device4_pin,LOW);
    delay(100);
    Serial.println("Connecting..");
    WiFiManager wifiManager;
    wifiManager.Sigmaway("Smart_Strip");

    Serial.println("connected...yeey :)");
  }


    //Print the message if RTC is not available
  if (! rtc.begin()) {
    Serial.println("Couldn't find RTC");
    while (1);
  }
  //Setup of time if RTC lost power or time is not set
  if (rtc.lostPower()) {
    //Sets the code compilation time to RTC DS3231
   rtc.adjust(DateTime(F(__DATE__), F(__TIME__)));
  }
}
void displaytime()
{
    //Set now as RTC time
  DateTime now = rtc.now();
  //Print RTC time to Serial Monitor
    Serial.print(now.year(), DEC);
    Serial.print('/');
    Serial.print(now.month(), DEC);
    Serial.print('/');
    Serial.print(now.day(), DEC);
    Serial.print(now.hour(), DEC);
    Serial.print(':');
    Serial.print(now.minute(), DEC);
    Serial.print(':');
    Serial.println(now.second(), DEC);
     y= now.year();
     m= now.month();
     dd= now.day();
     h= now.hour();
     mm= now.minute();
     s= now.second();
       
}
void loop()
{
  displaytime();
  if ((WiFi.status() != WL_CONNECTED) || (digitalRead(wifiReset)==1) || (!Ping.ping(remote_host))) {
 
     digitalWrite(device1_pin,LOW);
     digitalWrite(device2_pin,LOW);
     digitalWrite(device3_pin,LOW);
     digitalWrite(device4_pin,LOW);
    
    Serial.println("No network");

  }
  if (WiFi.status() == WL_CONNECTED) { //Check WiFi connection status

   if (digitalRead(wifiReset)==1){
       WiFi.disconnect(true);
       WiFiManager wifiManager;
       wifiManager.Sigmaway("Smart_strip");
       Serial.println("connected...yeey :)");
      }
   if(Ping.ping(remote_host)) {
      Serial.println("Success!!");
      digitalWrite(relay,HIGH);
      Serial.println("Relay On!");
      HTTPClient http;  //Declare an object of class HTTPClient
      //////////////////////////////////////////////////////////////////////////////////////////////////////////////
      http.begin("http://ranajoy0.000webhostapp.com/timer_toggle.php?did=node12&sid=5");  //Specify request destination
      //GET method
      http.GET();
      http.end();
  } 
  else if(!Ping.ping(remote_host))
  {
    Serial.println("Error :(");
    digitalWrite(relay,LOW);
    Serial.println("Relay Off!");
    HTTPClient http;  //Declare an object of class HTTPClient
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    http.begin("http://ranajoy0.000webhostapp.com/toggle1.php?did=node12&sid=5");  //Specify request destination
    //GET method
    http.GET();
    http.end();
  
  
  }
      
      if (digitalRead(button1)==1){
        Serial.println("Button 1 Detected");
        HTTPClient http;  //Declare an object of class HTTPClient
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////
        http.begin("http://ranajoy0.000webhostapp.com/manual_toggle.php?did=node12&sid=2");  //Specify request destination
        //GET method
        http.GET();
        http.end();
      }
      else if (digitalRead(button2)==1){
        Serial.println("Button 2 Detected");
        HTTPClient http;  //Declare an object of class HTTPClient
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////
        http.begin("http://ranajoy0.000webhostapp.com/manual_toggle.php?did=node12&sid=3");  //Specify request destination
        //GET method
        http.GET();
        http.end();
      }

    HTTPClient http;  //Declare an object of class HTTPClient
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    http.begin("http://ranajoy0.000webhostapp.com/device_status2.php?did=node12&sid=1");  //Specify request destination
    int httpCode1 = http.GET();                                                                  //Send the request
    if (httpCode1 > 0) { //Check the returning code
      String payload1 = http.getString();   //Get the request response payload
      Serial.println(payload1);
      String str1 = payload1.substring(0,2);
      String start_year1 = payload1.substring(3,7);
      String start_month1 = payload1.substring(8,10);
      String start_date1 = payload1.substring(11,13);
      String start_hour1 = payload1.substring(14,16);
      String start_minute1 = payload1.substring(17,19);
      //String start_second1 = payload1.substring(20,22);

      int start_y1=start_year1.toInt();
      int start_mo1=start_month1.toInt();
      int start_d1=start_date1.toInt();
      int start_h1=start_hour1.toInt();
      int start_m1=start_minute1.toInt();
     // int start_s1=start_second1.toInt();
  
      
      String end_year1 = payload1.substring(22,26);
      String end_month1 = payload1.substring(27,29);
      String end_date1 = payload1.substring(30,32);
      String end_hour1 = payload1.substring(33,35);
      String end_minute1 = payload1.substring(36,38);
     // String end_second1 = payload1.substring(42,44);

      int end_y1=end_year1.toInt();
      int end_mo1=end_month1.toInt();
      int end_d1=end_date1.toInt();
      int end_h1=end_hour1.toInt();
      int end_m1=end_minute1.toInt();
      //int end_s1=end_second1.toInt();
     
      
      if((start_y1==y) && (start_mo1==m) && (start_d1==dd) && (start_h1==h) && (start_m1==mm))
      {
        Serial.println("timer 1 started");
        if(device_status1==11)
        {
                  Serial.println("already on");

        }
        else if(device_status1==00)
        {                  Serial.println("on kar dia");

        HTTPClient http;  //Declare an object of class HTTPClient
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////
        http.begin("http://ranajoy0.000webhostapp.com/timer_toggle.php?did=node12&sid=1");  //Specify request destination
        //GET method
        http.GET();
        http.end();
        }
      }
      else if((end_y1==y) && (end_mo1==m) && (end_d1==dd) && (end_h1==h) && (end_m1==mm))
      {
        Serial.println("timer 1 ended");
         if(device_status1==11)
        { Serial.println(" off ho gya");

        HTTPClient http;  //Declare an object of class HTTPClient
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////
        http.begin("http://ranajoy0.000webhostapp.com/toggle1.php?did=node12&sid=1");  //Specify request destination
        //GET method
        http.GET();
        http.end();
        }
        else if(device_status1==00)
        {
                  Serial.println("already off");

        }
 
      }
/*Serial.println(start_year1);
Serial.println(start_month1);
Serial.println(start_date1);
Serial.println(start_hour1);
Serial.println(start_minute1);
//Serial.println(start_second1);
Serial.println(end_year1);
Serial.println(end_month1);
Serial.println(end_date1);
Serial.println(end_hour1);
Serial.println(end_minute1);
//Serial.println(end_second1);

Serial.println(start_y1);
Serial.println(start_mo1);
Serial.println(start_d1);
Serial.println(start_h1);
Serial.println(start_m1);
//Serial.println(start_s1);
Serial.println(end_y1);
Serial.println(end_mo1);
Serial.println(end_d1);
Serial.println(end_h1);
Serial.println(end_m1);
//Serial.println(end_s1);*/
      Serial.println("Device 1 Status="+str1);
      device_status1=str1.toInt();

      Serial.println();
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    http.begin("http://ranajoy0.000webhostapp.com/device_status2.php?did=node12&sid=2");  //Specify request destination
    int httpCode2 = http.GET();                                                                  //Send the request
    if (httpCode2 > 0) { //Check the returning code
      String payload2 = http.getString();   //Get the request response payload
      //Serial.println(payload2);
      String str2 = payload2.substring(0,2);
      Serial.println("Device 2 Status="+str2);
      device_status2=str2.toInt();
      String start_year2 = payload2.substring(3,7);
      String start_month2 = payload2.substring(8,10);
      String start_date2 = payload2.substring(11,13);
      String start_hour2 = payload2.substring(14,16);
      String start_minute2 = payload2.substring(17,19);
      //String start_second2 = payload2.substring(20,22);

      int start_y2=start_year2.toInt();
      int start_mo2=start_month2.toInt();
      int start_d2=start_date2.toInt();
      int start_h2=start_hour2.toInt();
      int start_m2=start_minute2.toInt();
      //int start_s2=start_second2.toInt();
  
     
      String end_year2 = payload2.substring(22,26);
      String end_month2 = payload2.substring(27,29);
      String end_date2 = payload2.substring(30,32);
      String end_hour2 = payload2.substring(33,35);
      String end_minute2 = payload2.substring(36,38);
      //String end_second2 = payload2.substring(42,44);

      int end_y2=end_year2.toInt();
      int end_mo2=end_month2.toInt();
      int end_d2=end_date2.toInt();
      int end_h2=end_hour2.toInt();
      int end_m2=end_minute2.toInt();
      //int end_s2=end_second2.toInt();

      if((start_y2==y) && (start_mo2==m) && (start_d2==dd) && (start_h2==h) && (start_m2==mm))
      {
        Serial.println("timer 2 started");
        if(device_status2==11)
        {
                  Serial.println("already on");

        }
        else if(device_status2==00)
        {                  Serial.println("on kar dia");

        HTTPClient http;  //Declare an object of class HTTPClient
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////
        http.begin("http://ranajoy0.000webhostapp.com/timer_toggle.php?did=node12&sid=2");  //Specify request destination
        //GET method
        http.GET();
        http.end();
        }
      }
      else if((end_y2==y) && (end_mo2==m) && (end_d2==dd) && (end_h2==h) && (end_m2==mm))
      {
        Serial.println("timer 2 ended");
         if(device_status2==11)
        { Serial.println(" off ho gya");

        HTTPClient http;  //Declare an object of class HTTPClient
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////
        http.begin("http://ranajoy0.000webhostapp.com/toggle1.php?did=node12&sid=2");  //Specify request destination
        //GET method
        http.GET();
        http.end();
        }
        else if(device_status2==00)
        {
                  Serial.println("already off");

        }
 
      }
      Serial.println();
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    http.begin("http://ranajoy0.000webhostapp.com/device_status2.php?did=node12&sid=3");  //Specify request destination
    int httpCode3 = http.GET();                                                                  //Send the request
    if (httpCode3 > 0) { //Check the returning code
      String payload3= http.getString();   //Get the request response payload
      //Serial.println(payload3);
      String str3 = payload3.substring(0,2);
      Serial.println("Device 3 Status="+str3);
      device_status3=str3.toInt();
      String start_year3 = payload3.substring(3,7);
      String start_month3 = payload3.substring(8,10);
      String start_date3 = payload3.substring(11,13);
      String start_hour3 = payload3.substring(14,16);
      String start_minute3 = payload3.substring(17,19);
      //String start_second3 = payload3.substring(20,22);

      int start_y3=start_year3.toInt();
      int start_mo3=start_month3.toInt();
      int start_d3=start_date3.toInt();
      int start_h3=start_hour3.toInt();
      int start_m3=start_minute3.toInt();
      //int start_s3=start_second3.toInt();
      
      String end_year3 = payload3.substring(22,26);
      String end_month3 = payload3.substring(27,29);
      String end_date3 = payload3.substring(30,32);
      String end_hour3 = payload3.substring(33,35);
      String end_minute3 = payload3.substring(36,38);
      //String end_second3 = payload3.substring(42,44);

      int end_y3=end_year3.toInt();
      int end_mo3=end_month3.toInt();
      int end_d3=end_date3.toInt();
      int end_h3=end_hour3.toInt();
      int end_m3=end_minute3.toInt();
      //int end_s3=end_second3.toInt();

      if((start_y3==y) && (start_mo3==m) && (start_d3==dd) && (start_h3==h) && (start_m3==mm))
      {
        Serial.println("timer 3 started");
        if(device_status3==11)
        {
                  Serial.println("already on");

        }
        else if(device_status3==00)
        {                  Serial.println("on kar dia");

        HTTPClient http;  //Declare an object of class HTTPClient
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////
        http.begin("http://ranajoy0.000webhostapp.com/timer_toggle.php?did=node12&sid=3");  //Specify request destination
        //GET method
        http.GET();
        http.end();
        }
      }
      else if((end_y3==y) && (end_mo3==m) && (end_d3==dd) && (end_h3==h) && (end_m3==mm))
      {
        Serial.println("timer 3 ended");
         if(device_status3==11)
        { Serial.println(" off ho gya");

        HTTPClient http;  //Declare an object of class HTTPClient
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////
        http.begin("http://ranajoy0.000webhostapp.com/toggle1.php?did=node12&sid=3");  //Specify request destination
        //GET method
        http.GET();
        http.end();
        }
        else if(device_status3==00)
        {
                  Serial.println("already off");

        }
 
      }
      Serial.println();
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    http.begin("http://ranajoy0.000webhostapp.com/device_status2.php?did=node12&sid=4");  //Specify request destination
    int httpCode4 = http.GET();                                                                  //Send the request
    if (httpCode4 > 0) { //Check the returning code
      String payload4 = http.getString(); //Get the request response payload
      //Serial.println(payload4);
      String str4 = payload4.substring(0,2);
      Serial.println("Device 4 Status="+str4);
      device_status4=str4.toInt();
      String start_year4 = payload4.substring(3,7);
      String start_month4 = payload4.substring(8,10);
      String start_date4 = payload4.substring(11,13);
      String start_hour4 = payload4.substring(14,16);
      String start_minute4 = payload4.substring(17,19);
      //String start_second4 = payload4.substring(20,22);

      int start_y4=start_year4.toInt();
      int start_mo4=start_month4.toInt();
      int start_d4=start_date4.toInt();
      int start_h4=start_hour4.toInt();
      int start_m4=start_minute4.toInt();
      //int start_s4=start_second4.toInt();
      
      String end_year4 = payload4.substring(22,26);
      String end_month4 = payload4.substring(27,29);
      String end_date4 = payload4.substring(30,32);
      String end_hour4 = payload4.substring(33,35);
      String end_minute4 = payload4.substring(36,38);
      //String end_second4 = payload4.substring(42,44);

      int end_y4=end_year4.toInt();
      int end_mo4=end_month4.toInt();
      int end_d4=end_date4.toInt();
      int end_h4=end_hour4.toInt();
      int end_m4=end_minute4.toInt();
      //int end_s4=end_second4.toInt();

       if((start_y4==y) && (start_mo4==m) && (start_d4==dd) && (start_h4==h) && (start_m4==mm))
      {
        Serial.println("timer 4 started");
        if(device_status4==11)
        {
                  Serial.println("already on");

        }
        else if(device_status4==00)
        {                  Serial.println("on kar dia");

        HTTPClient http;  //Declare an object of class HTTPClient
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////
        http.begin("http://ranajoy0.000webhostapp.com/timer_toggle.php?did=node12&sid=4");  //Specify request destination
        //GET method
        http.GET();
        http.end();
        }
      }
      else if((end_y4==y) && (end_mo4==m) && (end_d4==dd) && (end_h4==h) && (end_m4==mm))
      {
        Serial.println("timer 4 ended");
         if(device_status4==11)
        { Serial.println(" off ho gya");

        HTTPClient http;  //Declare an object of class HTTPClient
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////
        http.begin("http://ranajoy0.000webhostapp.com/toggle1.php?did=node12&sid=4");  //Specify request destination
        //GET method
        http.GET();
        http.end();
        }
        else if(device_status4==00)
        {
                  Serial.println("already off");

        }
 
      }
 
      Serial.println();
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Serial.println("-------------------------------------------------------------------------------------");
    http.end();   //Close connection
  }
  
  
  if(device_status1==11){
     digitalWrite(device1_pin,LOW);
     Serial.println("Device 1 ON");  
  }else if(device_status1==00){
     digitalWrite(device1_pin,HIGH);
     Serial.println("Device 1 OFF");
  }
  if(device_status2==11){
     digitalWrite(device2_pin,LOW); 
     Serial.println("Device 2 ON"); 
  }else if(device_status2==00){
     digitalWrite(device2_pin,HIGH);
     Serial.println("Device 2 OFF");
  }
  if(device_status3==11){
     digitalWrite(device3_pin,LOW);
     Serial.println("Device 3 ON");  
  }else if(device_status3==00){
     digitalWrite(device3_pin,HIGH);
     Serial.println("Device 3 OFF");
  }
  if(device_status4==11){
     digitalWrite(device4_pin,LOW);  
     Serial.println("Device 4 ON");
  }else if(device_status4==00){
     digitalWrite(device4_pin,HIGH);
     Serial.println("Device 4 OFF");
  }
  //delay(500);    //Send a request every 30 seconds
}
