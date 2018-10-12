#define SSID "Airtel 40mb"     // "SSID-WiFiname" 
#define PASS "coworks123"       // "password"
#define IP "192.168.1.18"     // your ip address
String msg = "GET /status.php?"; //change it with your key...
#define LS 2 // left sensor
#define RS 3 // right sensor 
#define LM1 5 // left motor 
#define LM2 4 // left motor 
#define RM1 7 // right motor 
#define RM2 6 // right motor 
#define en1 8 // left motor
#define en2 9 // right motor
String state;
String tempC;
int error;
void setup()
{   Serial.begin(115200); //or use default 115200.
  
  Serial.println("AT");
  delay(5000);
  if(Serial.find("OK")){
    connectWiFi();
  }
  pinMode(en1, OUTPUT);
  pinMode(en2, OUTPUT);
  pinMode(LS, INPUT); 
  pinMode(RS, INPUT); 
  pinMode(LM1, OUTPUT); 
  pinMode(LM2, OUTPUT); 
  pinMode(RM1, OUTPUT); 
  pinMode(RM2, OUTPUT); 
}
  
  void loop() 
  {  //Read temperature and humidity values from DHT sensor:
    start: //label 
    error=0;
    ir();
    tempC =state;
    updateTemp();
    //Resend if transmission is not completed 
    if (error==1){
    goto start; //go to label "start"
  }
  
    delay(1000); //Update every 1 hour
    digitalWrite(en1,HIGH); 
    digitalWrite(en2,HIGH);
  }
 
 void ir()
 {   
    if(digitalRead(LS) && digitalRead(RS)) // Move Forward 
    { 
      state= "nothingdetected";
      Serial.println(state);
      digitalWrite(LM1, LOW);
      digitalWrite(LM2, HIGH);
      digitalWrite(RM1, LOW);
      digitalWrite(RM2, HIGH);
      delay(500);
      digitalWrite(RM1, LOW); 
      digitalWrite(RM2, HIGH); 
      digitalWrite(LM1, HIGH); 
      digitalWrite(LM2, LOW); 

    }
    if(!(digitalRead(LS)) && digitalRead(RS)) // Turn Left
    { state="leftdetects";
      Serial.println(state);
      digitalWrite(LM1, LOW);
      digitalWrite(LM2, HIGH); 
      digitalWrite(RM1, HIGH); 
      digitalWrite(RM2, LOW); 
    }
    if(digitalRead(LS) && !(digitalRead(RS))) // turn right 
    { state="rightdetects";
      Serial.println(state);
      digitalWrite(RM1, LOW); 
      digitalWrite(RM2, HIGH); 
      digitalWrite(LM1, HIGH); 
      digitalWrite(LM2, LOW); 
    }
    if(!(digitalRead(LS)) && !(digitalRead(RS))) // move forward 
    { state="bothdetects";
      Serial.println(state);
      digitalWrite(LM1, HIGH); 
      digitalWrite(LM2, LOW);   
      digitalWrite(RM1, HIGH); 
      digitalWrite(RM2, LOW); 
    } 
}
boolean connectWiFi(){
  Serial.println("AT+CWMODE=1");
  delay(2000);
  String cmd="AT+CWJAP=\"";
  cmd+=SSID;
  cmd+="\",\"";
  cmd+=PASS;
  cmd+="\"";
  Serial.println(cmd);
  delay(5000);
  if(Serial.find("OK")){
    return true;
  }else{
    return false;
  }
}
void updateTemp(){
  String cmd = "AT+CIPSTART=\"TCP\",\"";
  cmd += IP;
  cmd += "\",80";
  Serial.println(cmd);
  delay(2000);
  if(Serial.find("Error")){
    return;
  }
  cmd = msg ;
  cmd += "data=";    //field 1 for temperature
  cmd += tempC;
  //cmd += "&field2=";  //field 2 for humidity
  //cmd += String(hum);
  cmd += "\r\n";
  
  Serial.print("AT+CIPSEND=");
  Serial.println(cmd.length());
  if(Serial.find(">")){
    Serial.print(cmd);
  }
  else{
    Serial.println("AT+CIPCLOSE");
    //Resend...
    error=1;
  }
}
