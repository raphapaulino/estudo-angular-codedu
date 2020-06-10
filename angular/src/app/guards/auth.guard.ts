import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { AuthService } from '../services/auth.service';

// @Injectable({
//   providedIn: 'root'
// })
@Injectable()
export class AuthGuard implements CanActivate {

  constructor(private authService: AuthService, private router: Router) { }

  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    const isAuth = this.authService.isAuth();
    // console.log('Redirecionamento: ');
    // console.log(isAuth);
    this.redirectIfUnauthenticated(isAuth);
    return isAuth;
  }

  private redirectIfUnauthenticated(isAuth: boolean) {
    // console.log('Redirecionamento: ');
    // console.log(isAuth);
    if (!isAuth) {
      // console.log('Redirecionamento: ');
      // console.log(isAuth);
      this.router.navigate(['login']);
    }
  }
  
}
