import { TestBed } from '@angular/core/testing';

import { BuildersService } from './builder.service';

describe('BuilderService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: BuildersService = TestBed.get(BuildersService);
    expect(service).toBeTruthy();
  });
});
