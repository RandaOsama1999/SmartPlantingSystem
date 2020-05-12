const int redPin = 13;
const int bluePin=12; 
const int greenPin = 11; 
int value=0;

void setup() 
{ 
  Serial.begin(9600); 
  pinMode(redPin, OUTPUT); 
  pinMode(bluePin, OUTPUT); 
  pinMode(greenPin, OUTPUT);
}
 
void loop() 
{
 while (Serial.available())
 {
  value = Serial.read();
 }
     
 if (value == '1'){
   digitalWrite(redPin, HIGH);   
   digitalWrite(bluePin, LOW); 
   digitalWrite(greenPin, LOW);  
 } 
 else if (value == '0'){
  digitalWrite(redPin, LOW);     
  digitalWrite(bluePin, HIGH);
  digitalWrite(greenPin, HIGH);  
  }
  else{
    digitalWrite(redPin, LOW);     
    digitalWrite(bluePin, LOW);
    digitalWrite(greenPin, LOW);  
  }
}
