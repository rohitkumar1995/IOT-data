#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h>
#include <ESP8266mDNS.h>
#include <ESP8266HTTPClient.h>
const int sensor_pin = A0;  /* Connect Soil moisture analog sensor pin to A0 of NodeMCU */

 const char* ssid = "Airtel 40mb";
 const char* password = "coworks123";
 float moisture_percentage;
ESP8266WebServer server(80);


void setup() {
  Serial.begin(115200); /* Define baud rate for serial communication */
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

void moisture()
{
  
  moisture_percentage = ( 100.00 - ( (analogRead(sensor_pin)/1023.00) * 100.00 ) );
  Serial.print("Soil Moisture(in Percentage) = ");
  Serial.print(moisture_percentage);
  Serial.println("%");

  delay(1000);
}
void loop() {
  server.handleClient();

      moisture();

       
      HTTPClient http;
        String url = "http://rohitkumarz547.000webhostapp.com/moisture.php?temp="+String(moisture_percentage);
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

}
  


void webserver() {
  
  moisture();
  String content = "<html> <head> <meta http-equiv='refresh' content='1'> </head><body>";
  content += "<center><h2>The Soil Moisture(in Percentage) is: ";
  content += moisture_percentage;
  content += " cm </h2></center> </body></html>";
  server.send(200, "text/html", content);
}
 
void handleNotFound(){
  
  String message = "File Not Found\n\n";
  server.send(404, "text/plain", message);
 }

