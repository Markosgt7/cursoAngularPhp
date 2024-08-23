import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

import { NgbModule } from '@ng-bootstrap/ng-bootstrap';

import { MatInputModule } from '@angular/material/input';

//importacion  manual del modulo desde angular material
import { MatToolbarModule } from '@angular/material/toolbar';
//importacion de modulo para el manejo de iconos de material 
import {MatIconModule} from '@angular/material/icon';
//importacion de modulo para el manejo de sidebar
import {MatSidenavModule} from '@angular/material/sidenav';
//importacion de modulo para los divisores
import {MatDividerModule} from '@angular/material/divider';
//importacion de modulo para el manejo de botones
import {MatButtonModule} from '@angular/material/button';





@NgModule({
  declarations: [AppComponent],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    NgbModule,
    MatInputModule,
    MatToolbarModule,
    MatIconModule,
    MatSidenavModule,
    MatDividerModule,
    MatButtonModule
  ],
  providers: [],
  bootstrap: [AppComponent],
})
export class AppModule {}
