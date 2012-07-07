
// Festlegen der Pins fr die Spalten und Reihen
int COL_PINS[] = {26, 31, 32}; // Hier hängen die Pins die anschliessend die Spannung (+5V) liefern
int ROW_PINS[][3] = {
                      {4,7, 10}, //oberste Reihe  R-G-B
                      {5,8,11},  // zweite Reihe R-G-B
                      {6,9,12}  //dritte Reihe R-G-B
                     };

#define ROW_COUNT (sizeof(ROW_PINS)/sizeof(ROW_PINS[0]))
#define COL_COUNT (sizeof(COL_PINS)/sizeof(COL_PINS[0]))

#define MULTIPLEX_DELAY_MS = 15;
#define PATTERN_DELAY_MS = 45;
#define PATTERN_SIZE= 2;

                     
//standardfarben der Reihen wenn nix gesetzt wurde
int default_single_color[] = {255,255,255};
int default_fadestart_color[] = {255,0,0};

int aktuelle_fadecolor[3];
int default_row_color [] [3] = { {255,0,0},{0, 255,0}, {0,0,255} }; 
int default_matrix_color [] [3][3] = {
                                    { {255,0,0},{0, 255,0}, {0,0,255} },
                                    { {255,255,0},{0, 255,255}, {255,0,255} },
                                    { {255,255,255},{125, 125,125}, {200,200,200} }
                                    
                                  }; 
int chosen_matrix_color [] [3][3] = {
                                    { {0,0,0},{0, 0,0}, {0,0,0} },
                                    { {0,0,0},{0, 0,0}, {0,0,0} },
                                    { {0,0,0},{0, 0,0}, {0,0,0} }
                                    
                                  };
int ttt_matrix_color [] [3][3] = {
                                    { {0,0,0},{0, 0,0}, {0,0,0} },
                                    { {0,0,0},{0, 0,0}, {0,0,0} },
                                    { {0,0,0},{0, 0,0}, {0,0,0} }
                                    
                                  };
int chosen_single_color[] = {0,0,0};
int chosen_row_color [] [3] = { {0,0,0},{0, 0,0}, {0,0,0} }; 
boolean default_color;

// platzhalter um von einer Farbe zur anderen zu faden
int chosen_fade_startcolor[3] = {0,0,0};
int chosen_fade_endcolor[3] = {0,0,0};
//uint16_t final_color[3];  

int showmode = 3;
int fadeindex = 0;

//unsere Platzhalter nachher zum übertragen der Daten aus dem PHP
char inData[70]; // Allocate some space for the string
char inChar; // Where to store the character read
int dat_ind; // Index into array; where to store the character
boolean fcstart, gotcmd, fcend;

void setup(){
   default_color =  true;
   fcstart = false; gotcmd = false;
   fcend = true;
   dat_ind = 0;
 //setzen der PWM-Ausgänge
 for (int i = 0; i<3; i++){
     pinMode (COL_PINS[i], OUTPUT); // Setzen der Spalten
     digitalWrite(COL_PINS[i], HIGH);
   //  println ("Spalte "+i+": "+COL_PINS[i]+" als Ausgang gesetzt!");
   for (int j = 0; j<3; j++) {
     pinMode (ROW_PINS[i][j], OUTPUT); //Setzen der Reihenpins in der Spalte
   //  println ("Reihe "+j+": "+ROW_PINS[i][j]+" als Ausgang gesetzt!");
   }
     
 }

//Setzt einen listener auf den Serialport 
Serial.begin(115200);
}

void fetchCommand(){
   while(Serial.available() > 0){
       inChar = Serial.read();
      if(inChar == '(') {
          fcstart = true;
          fcend = false;
          clearCommand();
      }else if ( inChar == ')') {
          fcstart  = false;
          fcend = true;
          gotcmd = true;
      } else if ((fcstart) && !(fcend)){
          if(dat_ind < 69){
            inData[dat_ind] = inChar; // Store i
            dat_ind++;
            inData[dat_ind] = '\0';
          }
     } 
  } //Serial.print(inData);
  //Serial.println(" infetch");
   // Null terminate the string*/
   inData[dat_ind] = '\0';
}  

//
void clearCommand(){
    inData[0] = '\0';
    dat_ind=0;  
    gotcmd = false;
}

void loop(){
  
   //Wenn es Signale aus dem Serial gibt, dann sammel sieh ein  
   fetchCommand();   

     // hat die Nachricht aus dem Serial eine gewisse Länge
     if(gotcmd){
          
         //checke ob die Nachricht mit den Zeichen "xx" beginnt        
         if (inData[0] == 'z' && inData[1] == 'z'){       
         
          
          char color[7]; 
          int offset = 3;
          
          for (int c_int=0; c_int < 7; c_int++){
            color[c_int] = inData[(c_int+offset)]; 
          }
           color[7] = '\0'; 
           setColor( chosen_single_color, color );
           clearCommand();
       }
         //checke ob die Nachricht mit den Zeichen "yy" beginnt   
         else if (inData[0] == 'y' && inData[1] == 'y'){ 
          char color[3][7];
          int iDindex = 3;
                        
          for (int row=0; row<3; row++){
             for (int c_int=0; c_int<7; c_int++, iDindex++){       
                if ( c_int < 6) { color[row][c_int] = inData[iDindex]; }
                else { color[row][c_int] = '\0'; }
            } 
          }
          
          // nimm die Farben und setz sie für das einfarbige Farblayout
           for (int row=0; row<3; row++){
             setColor( chosen_row_color[row], color[row] );
           }
            clearCommand();
        }
         //checke ob die Nachricht mit den Zeichen "zz" beginnt 
         else if (inData[0] == 'x' && inData[1] == 'x'){  
         char color[9][7];
          int iDindex = 3;
                        
          for (int row=0; row<9; row++){
             for (int c_int=0; c_int<7; c_int++, iDindex++){       
                if ( c_int <=5) { color[row][c_int] = inData[iDindex]; }
                else { color[row][c_int] = '\0'; }
                
            } 
            //color[10][0] = '\0';
            Serial.println( color[row]);
          }
          int col_ind = 0;
          // nimm die Farben und setz sie für das einfarbige Farblayout
           for (int col=0; col<3; col++){
           for (int row=0; row<3; row++){
             setColor( chosen_matrix_color[col][row], color[col_ind++] );
           } }
            clearCommand();
        }
                 //checke ob die Nachricht mit den Zeichen "zz" beginnt 
         else if (inData[0] == 'z' && inData[1] == 'f'){            
          char color[2][7];
          int iDindex = 3;          
                        
          for (int row=0; row<2; row++){
             for (int c_int=0; c_int<7; c_int++, iDindex++){       
                if ( c_int < 6) { color[row][c_int] = inData[iDindex]; }
                else { color[row][c_int] = '\0'; }
            } 
          }
          
          setColor(chosen_fade_startcolor, color[0]);
          setColor(chosen_fade_endcolor, color[1]);
          clearCommand();
           
           
           
           
        }
         else if (inData[0] == 'd' && inData[1] == 'e' && inData[2] == 'f'){ 
           if (default_color == true) { default_color = false;}
           else { default_color = true; }
          // showmode = showmode;
           clearCommand();
         
        }
        else if (inData[0] == 't' && inData[1] == 't' && inData[2] == 't'){  
         char color[9][7];
          int iDindex = 4;
                        
          for (int row=0; row<9; row++){
             for (int c_int=0; c_int<7; c_int++, iDindex++){       
                if ( c_int < 6) { color[row][c_int] = inData[iDindex]; }
                else { color[row][c_int] = '\0'; }
            } 
          }
          int col_ind = 0;
          // nimm die Farben und setz sie für das einfarbige Farblayout
           for (int col=0; col<3; col++){
           for (int row=0; row<3; row++){
             setColor( ttt_matrix_color[col][row], color[col_ind++] );
           } }
            clearCommand();
        }
          
         else if (inData[0] == 's' && inData[1] == 'm'){
           showmode = convhex(inData[2]);          
           clearCommand();
        }
        else { showmode = 3 ;}
   }// hat die Nachricht aus dem Serial eine gewisse Länge nicht, wird sie gelöscht 
   
   if (showmode == 0) { /* unsere anwendung ist off*/ }
   else if(showmode == 1){ setLED_matrix();  }
   else if(showmode == 2){ setLED_row(); }
   else if(showmode == 3){ setLED_full(); }// mpx_draw_row();
   else if(showmode == 4){ fadetocolor (); }
   else if(showmode == 5){ tictactoe(); }
   else if(showmode == 6){ mpx_draw_fade(); }
}
 

void setLED_full(){
   int last_row = 0;
   int last_col = COL_COUNT-1;
  for (int col = 0; col < COL_COUNT; last_col = col++) {  
  for (int row = 2;row>= 0; last_row = row--){
    if (default_color){
       setLED ( row, col, 5, (int*)default_single_color);
     }else{
       setLED ( row, col, 5, (int*)chosen_single_color);
     }  
    }
  }
}
void setLED_row(){
   int last_row = 0;
   int last_col = COL_COUNT-1;
  for (int col = 0; col < COL_COUNT; last_col = col++) {  
    for (int row = 2;row>= 0; last_row = row--){
      if (default_color){
         setLED ( row, col, 5, (int*)default_row_color[row]);
       }else{
         setLED ( row, col, 5, (int*)chosen_row_color[row]);
       }  
    }
  }
}
void setLED_matrix(){
   int last_row = 0;
   int last_col = COL_COUNT-1;
   for (int row = 2;row>= 0; last_row = row--){
  for (int col = 0; col < COL_COUNT; last_col = col++) {  
    
if (default_color){
  setLED ( row, col, 5, (int*)default_matrix_color[row][col]);
}else {
  setLED ( row, col, 5, (int*)chosen_matrix_color[row][col]);
}
    }
  }
}
void tictactoe(){
   int last_row = 0;
   int last_col = COL_COUNT-1;
   for (int row = 2;row>= 0; last_row = row--){
   for (int col = 0; col < COL_COUNT; last_col = col++) {  
     setLED ( row, col, 5, (int*)ttt_matrix_color[row][col]);

    }
  }
}


void mpx_draw_fade(){
                default_color = false; 
                if (fadeindex == 0){ 
                   aktuelle_fadecolor[0] = default_fadestart_color[0];
                    aktuelle_fadecolor[1] = default_fadestart_color[1]; 
                   aktuelle_fadecolor[2] = default_fadestart_color[2];  
                 }
                else if (fadeindex < 255) // First phase of fades
                {
                  aktuelle_fadecolor[0]  -= 1; // Red down
                  aktuelle_fadecolor[1]  += 1; // Green up
                  aktuelle_fadecolor[2]   = 0; // Blue low
                }
                else if (fadeindex < 510) // Second phase of fades
                {
                  aktuelle_fadecolor[0]  = 0; // Red down
                  aktuelle_fadecolor[1] -= 1; // Green up
                  aktuelle_fadecolor[2] += 1; // Blue low
                } 
                else if (fadeindex < 765) // Third phase of fades
                {
                  aktuelle_fadecolor[0]  += 1; // Red down
                  aktuelle_fadecolor[1]   = 0; // Green up
                  aktuelle_fadecolor[2]  -= 1; // Blue low
                }
                else // Re-set the counter, and start the fades again
                {
                  fadeindex = 1;
                } 
               fadeindex += 1;
         for (int col = 0; col < COL_COUNT;col++) {
             for (int row = 2;row>= 0; row--){
               setLED ( row, col,  5, (int*)aktuelle_fadecolor);
               
             }}
             // delay(50); 
}


void setLED (int row, int col, int del, int color[]){
  analogWrite (ROW_PINS[col][0], color[0]);
  analogWrite (ROW_PINS[col][1], color[1]);
  analogWrite (ROW_PINS[col][2], color[2]);
  digitalWrite(COL_PINS[row], LOW);
  delay (1);
  digitalWrite(COL_PINS[row], HIGH);
  analogWrite (ROW_PINS[col][0], 0);
  analogWrite (ROW_PINS[col][1], 0);
  analogWrite (ROW_PINS[col][2], 0);
}

void setColor(int target[], char color[]){
 
  char r[] = { color[0], color[1]};
  char g[] = { color[2], color[3]};
  char b[] = { color[4], color[5]}; 
  
  int rint = convert_hex( r );  
  int gint = convert_hex( g ); 
  int bint = convert_hex( b ); 

  target [0] = rint <= 255 ? rint : 0;
  target [1] = gint <= 255 ? gint : 0;
  target [2] = bint <= 255 ? bint : 0;
}

// umrechnung der einzelnen HexStellen in int-Werte
int convhex(char w) {
  
    byte c = w;
    
    if (c >= '0' && c <= '9') { return c - '0'; } 
    else if (c >= 'a' && c <= 'f') { return c - 'a' + 10; } 
    else if (c >= 'A' && c <= 'F') { return c - 'A' + 10; } 
    else { return -1; }   // getting here is bad: it means the character was invalid

}
//zusammenrechnen der zwei stellen in eine int-Zahl von 0-255
int convert_hex(char farbe[]){
  
    byte w1 = convhex(farbe[0]);
    byte w2 = convhex(farbe[1]);
    
    if (w1<0 || w2<0) {  return 00;  }// an invalid hex character was encountered
    else { return int((w1*16) + w2); }
}


void fadetocolor (){
  fadebetweencolor (chosen_fade_startcolor, chosen_fade_endcolor, 250);
  fadebetweencolor (chosen_fade_endcolor, chosen_fade_startcolor, 250);
}

void fadebetweencolor ( int startcolor[], int endcolor[], int steps){
  for(int akt_step = 0; akt_step < steps; akt_step++){
    Blend( startcolor, endcolor, akt_step, steps);
    for (int col = 0; col < COL_COUNT; col++) {  
      for (int row = 2;row>= 0; row--){
               setLED ( row, col, 5, (int*)aktuelle_fadecolor);              
      }
    }
  }  
}
void Blend(int color_start[3],int color_end[3],int blend_level, int max_level){
      aktuelle_fadecolor[0] = (int) (color_start[0] - (blend_level*((color_start[0]-(float)color_end[0])/max_level)));
      aktuelle_fadecolor[1] = (int)(color_start[1] - (blend_level*((color_start[1]-(float)color_end[1])/max_level)));
      aktuelle_fadecolor[2] = (int)(color_start[2] - (blend_level*((color_start[2]-(float)color_end[2])/max_level)));
}

int getDifference ( int a, int b){
   if(a>=b) {
    return a-b;
  } else { 
    return b-a;
  } 
}  
