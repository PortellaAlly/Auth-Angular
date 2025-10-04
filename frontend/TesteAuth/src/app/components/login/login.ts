import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { AuthService } from '../../services/auth';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './login.html'
})
export class LoginComponent {
  email = '';
  senha = '';

  constructor(private authService: AuthService) {}

  onLogin() {
    this.authService.login(this.email, this.senha).subscribe({
      next: (res) => console.log('Login:', res),
      error: (err) => console.error('Erro:', err)
    });
  }
}