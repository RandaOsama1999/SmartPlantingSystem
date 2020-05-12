#include "DHT.h"
#define DHTPIN 7
#define DHTTYPE DHT11
int sensorPin = 2;
//Variable to store the sensor reading
int sensorValue;
DHT dht(DHTPIN, DHTTYPE);
void setup() 
{ 
  Serial.begin(9600);
  pinMode(sensorPin, OUTPUT); 
  dht.begin();
}
 
void loop() 
{
  delay(100);
  float h=dht.readHumidity();
  float t=dht.readTemperature(); 

   if(isnan(h) || isnan(t)){
    Serial.println("Failed");
   }
   float hic=dht.computeHeatIndex(t,h,false);
   
   Serial.print(t,0);
   Serial.print(" ");
   sensorValue = analogRead(sensorPin);
    //Output the value to the serial
   Serial.println(sensorValue);

}
