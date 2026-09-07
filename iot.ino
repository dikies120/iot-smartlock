#include <Wire.h>
#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include <Servo.h>
#include <LiquidCrystal_I2C.h>

const char* ssid = "kudanil";          
const char* password = "yahudianjay";  

ESP8266WebServer server(80); 
Servo myServo;
#define SERVO_PIN D8

LiquidCrystal_I2C lcd(0x27, 16, 2);

#define BUZZER_PIN D7

bool isDoorOpen = false;          
unsigned long servoMoveStartTime = 0; 
int servoTargetPosition = 0;       
bool isServoMoving = false;       

bool isBuzzing = false;           
unsigned long buzzStartTime = 0;  
int buzzDuration = 500;  

void buzz(int duration) {
    isBuzzing = true;
    buzzStartTime = millis();       
    buzzDuration = duration;        
    digitalWrite(BUZZER_PIN, HIGH); 
}

void handleBuzzer() {
    if (isBuzzing && millis() - buzzStartTime >= buzzDuration) {
        digitalWrite(BUZZER_PIN, LOW); 
        isBuzzing = false;            
    }
}

void openDoor() {
    if (!isDoorOpen) {
        servoTargetPosition = 180;     
        servoMoveStartTime = millis();  
        isServoMoving = true;          
        isDoorOpen = true;              
        server.send(200, "text/plain", "Door opened");
        lcd.clear();
        lcd.print("Door Open");
        buzz(500);                     
    } else {
        server.send(200, "text/plain", "Door already open");
    }
}

void closeDoor() {
    if (isDoorOpen) {
        servoTargetPosition = 0;        
        servoMoveStartTime = millis();  
        isServoMoving = true;           
        isDoorOpen = false;             
        server.send(200, "text/plain", "Door closed");
        lcd.clear();
        lcd.print("Door Closed");
        buzz(500);                      
    } else {
        server.send(200, "text/plain", "Door already closed");
    }
}

void setup() {
    Serial.begin(115200); 
    Serial.println();

    WiFi.begin(ssid, password);
    Serial.print("Connecting to WiFi");
    while (WiFi.status() != WL_CONNECTED) {
        delay(1000);
        Serial.print(".");
    }
    Serial.println();
    Serial.println("WiFi connected!");
    Serial.print("IP Address: ");
    Serial.println(WiFi.localIP());

    myServo.attach(SERVO_PIN);
    myServo.write(0); 

    Wire.begin(D2, D1); 
    lcd.begin(16, 2);   
    lcd.backlight();
    lcd.print("Smart Lock Ready");

    pinMode(BUZZER_PIN, OUTPUT); 

    server.on("/open", HTTP_GET, []() {
        Serial.println("Open door request received");
        openDoor();
    });

    server.on("/close", HTTP_GET, []() {
        Serial.println("Close door request received");
        closeDoor();
    });

    server.begin(); 
    Serial.println("Server started!");
    Serial.print("Access the server at http://");
    Serial.print(WiFi.localIP());
    Serial.println("/");
}

void loop() {
    server.handleClient(); 

    if (isServoMoving) {
        unsigned long currentTime = millis();
        if (currentTime - servoMoveStartTime < 500) {
            int pos = map(currentTime - servoMoveStartTime, 0, 500, myServo.read(), servoTargetPosition);
            myServo.write(pos);
        } else {
            myServo.write(servoTargetPosition);
            isServoMoving = false;
        }
    }

    handleBuzzer();
}
