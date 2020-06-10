import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ProdutctListComponent } from './product-list.component';

describe('ProdutctListComponent', () => {
  let component: ProdutctListComponent;
  let fixture: ComponentFixture<ProdutctListComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ProdutctListComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ProdutctListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
