import { Injectable } from '@angular/core';
import { Observable } from 'rxjs/internal/Observable';
import { HttpClient } from '@angular/common/http';
import { tap } from 'rxjs/operators'
import { JwtHelperService } from '@auth0/angular-jwt';
import { User } from '../model';
const TOKEN_KEY = 'angular_token';
import { environment } from 'src/environments/environment';

// console.log(environment.production)
// console.log(environment.api)
// console.log(environment.api.url)

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  me: User = null;

  constructor(private http: HttpClient) {
    const token = this.getToken();
    this.setUserFromToken(token);
  }

  login(user: {email: string, password: string}): Observable<{token: string}>  {
    return this.http.post<{token: string}>( `${environment.api.url}/login`, user)
      .pipe(
        tap(response => {
          this.setToken(response.token);
        })
      );
  }

  private setUserFromToken(token: string) {
    // console.log(token);
    const decodedPayload = new JwtHelperService().decodeToken(token); //3 partes - pegar 2 partes
    // console.log('decodedPayload: ');
    // console.log(decodedPayload);

    this.me = decodedPayload ? {
      id: decodedPayload.sub,
      name: decodedPayload.name,
      email: decodedPayload.email
    }: null;

    // console.log('me: ');
    // console.log(this.me);
  }

  setToken(token: string) {
    this.setUserFromToken(token);
    token ? window.localStorage.setItem(TOKEN_KEY, token)
          : window.localStorage.removeItem(TOKEN_KEY);
  }

  getToken(): string | null {
    return window.localStorage.getItem(TOKEN_KEY)
  }

  isAuth(): boolean {
    const token = this.getToken();
    const JWT_BLACKLIST_GRACE_PERIOD = 30;
    // console.log('Expirado? ')
    // console.log(new JwtHelperService().isTokenExpired(token, JWT_BLACKLIST_GRACE_PERIOD));
    return !new JwtHelperService().isTokenExpired(token, JWT_BLACKLIST_GRACE_PERIOD);
  }

  logout(): Observable<any> {
    return this.http
      .post<{ token: string }>( `${environment.api.url}/logout`, {})
      .pipe(
        tap(() => {
          this.setToken(null);
        })
      );
  }
}
