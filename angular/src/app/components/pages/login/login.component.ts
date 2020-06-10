import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  credentials = {
    email: 'admin@user.com',
    password: 'password'
  }

  showMessageError = false;

  constructor(private authService: AuthService, private router: Router) {}

  ngOnInit(): void {

  }

  submit() {
    this.authService.login(this.credentials)
      .subscribe((data) => {
        this.router.navigate(['categories/list']);
      }, responseError => {
        // console.log(responseError)
        this.showMessageError = true;
      });
    return false;
  }

}
