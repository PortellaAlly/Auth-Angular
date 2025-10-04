import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private apiUrl = 'http://localhost/Auth-Angular/backend/auth';

  constructor(private http: HttpClient) { }

  register(nome: string, email: string, senha: string): Observable<any> {
    return this.http.post(`${this.apiUrl}/register.php`, { nome, email, senha });
  }

  login(email: string, senha: string): Observable<any> {
    return this.http.post(`${this.apiUrl}/login.php`, { email, senha });
  }
}