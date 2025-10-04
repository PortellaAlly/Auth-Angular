import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LoginComponent } from './components/login/login';
import { RegisterComponent } from './components/register/register';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [CommonModule, LoginComponent, RegisterComponent],
  templateUrl: './app.html',
  styleUrl: './app.css'
})
export class AppComponent {
  telaAtual = 'login';

  mostrarLogin() {
    this.telaAtual = 'login';
  }

  mostrarRegistro() {
    this.telaAtual = 'registro';
  }
}