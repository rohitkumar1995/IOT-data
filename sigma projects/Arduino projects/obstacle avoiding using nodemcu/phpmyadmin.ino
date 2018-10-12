#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h>
#include <ESP8266mDNS.h>
#include <ESP8266HTTPClient.h>

 
const char* ssid = "Tikona";
const char* password = "gosigmaway@123";
 
ESP8266WebServer server(80);

 
// defines pins numbers trigger and echo
const int trigPin = 14;  //Digital port D5
const int echoPin = 12;  //Digital port D6
const int leftForward = D1;
const int leftBackward = D2;
const int rightForward = D3;
const int rightBackward = D4;
const int en1= D7;
const int en2= D8;
 
// defines variables
long duration;
float distance=0;
float Mdistance,temp;
 
const int led = LED_BUILTIN;
 
void setup(){
  pinMode(en1, OUTPUT);
  pinMode(en2, OUTPUT);  
  pinMode(leftForward,OUTPUT);
  pinMode(leftBackward,OUTPUT);
  pinMode(rightForward,OUTPUT);
  pinMode(rightBackward,OUTPUT);
  pinMode(led, OUTPUT);
  pinMode(trigPin, OUTPUT); // Sets the trigPin as an Output
  pinMode(echoPin, INPUT); // Sets the echoPin as an Input
  digitalWrite(led, 0);
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  Serial.println("");
 
  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
 
  server.on("/", webserver);
  server.onNotFound(handleNotFound);
  server.begin();
  Serial.println("HTTP server started");
}
 
void loop(){
      server.handleClient();

      distanceData();

      temp=distance; 
      HTTPClient http;
        String url = "http://192.168.0.104/add.php?temp="+String(temp);
        Serial.println(url);     
        http.begin(url);
       
        //GET method
      int httpCode = http.GET();
        if(httpCode > 0)
        {
          Serial.printf("[HTTP] GET...code: %d\n", httpCode);
          if(httpCode == HTTP_CODE_OK)
          {
              String payload = http.getString();
              Serial.println(payload);
          }
       }
       else
      {
            Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
       }
          http.end();
          delay(300);

  digitalWrite(en1,HIGH);
  digitalWrite(en2,HIGH);


}
 
void distanceData(){
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  
  // Sets the trigPin on HIGH state for 10 micro seconds
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  
  // Reads the echoPin, returns the sound wave travel time in microseconds
  duration = pulseIn(echoPin, HIGH);
  
  // Calculating the distance
  distance= (duration*0.034)/2;
  delay (100);
   if (distance< 25)
  {
      // run left
  digitalWrite(leftForward,LOW);
  digitalWrite(leftBackward,HIGH);
  digitalWrite(rightForward,HIGH);
  digitalWrite(rightBackward,LOW);
  delay(100);
  }
  else
  {
      // run forward
  digitalWrite(leftForward,HIGH);
  digitalWrite(leftBackward,LOW);
  digitalWrite(rightForward,HIGH);
  digitalWrite(rightBackward,LOW);
  }
     

}
 
void webserver() {
  digitalWrite(led, !digitalRead(led));
  distanceData();
  String content = "<html> <head> <meta http-equiv='refresh' content='1'> </head><body>";
  content += "<center><h2>The distance is: ";
  content += distance;
  content += " cm </h2></center> </body></html>";
  server.send(200, "text/html", content);
}
 
void handleNotFound(){
  digitalWrite(led, 1);
  String message = "File Not Found\n\n";
  server.send(404, "text/plain", message);
  digitalWrite(led, 0);
}



