import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { AuthService } from '../../services/auth';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './register.html'
})
export class RegisterComponent {
  nome = '';
  email = '';
  senha = '';

  constructor(private authService: AuthService) {}

  onRegister() {
    this.authService.register(this.nome, this.email, this.senha).subscribe({
      next: (res) => console.log('Sucesso:', res),
      error: (err) => console.error('Erro:', err)
    });
  }
}