import { Component, ElementRef, OnInit } from '@angular/core';

declare const $; //ES6

@Component({
  selector: 'modal',
  templateUrl: './modal.component.html',
  styleUrls: ['./modal.component.css']
})
export class ModalComponent implements OnInit {

  constructor(private element: ElementRef) { }

  ngOnInit(): void {
  }

  public show() {
    this.getJQueryElement().modal('show');
  }

  public hide() {
    this.getJQueryElement().modal('hide');
  }

  private getJQueryElement() {
    const nativeElement = this.element.nativeElement;
    // console.log(nativeElement)
    return $(nativeElement.firstChild)
  }

}
