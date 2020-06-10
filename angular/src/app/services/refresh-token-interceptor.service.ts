import { Injectable } from '@angular/core';
import { HttpInterceptor, HttpRequest, HttpHandler, HttpEvent, HttpErrorResponse, HttpResponseBase } from '@angular/common/http';
import { Observable } from 'rxjs/internal/Observable';
import { tap } from 'rxjs/operators';
import { AuthService } from './auth.service';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class RefreshTokenInterceptorService implements HttpInterceptor {

  constructor(private authService: AuthService, private router: Router) { }

  intercept(req: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    return next
      .handle(req)
      .pipe(
        tap((event: HttpEvent<any>) => {
          // console.log  (event);
          this.setNewTokenIfResponseIsValid(event);
        }, (eventError: HttpEvent<any>) => {
          this.setNewTokenIfResponseIsValid(eventError);
          this.redirectToLoginIfUnauthenticated(eventError);
        })
      )
  }

  private redirectToLoginIfUnauthenticated(eventError: HttpEvent<any>) {
    if (eventError instanceof HttpErrorResponse && eventError.status == 401) {
      this.authService.setToken(null);
      this.router.navigate(['login']);
    }
  }

  private setNewTokenIfResponseIsValid(event: HttpEvent<any>) {
    if (event instanceof HttpResponseBase) {
      const authorizationHeader = event.headers.get('authorization');
      // console.log(authorizationHeader);
      if (authorizationHeader) {
        const token = authorizationHeader.split(' ')[1];
        this.authService.setToken(token);
      }
    }
  }
}
