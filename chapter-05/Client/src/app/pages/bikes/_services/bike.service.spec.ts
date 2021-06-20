import { TestBed } from '@angular/core/testing';
import { BikesService } from './bike.service';



describe('BikeService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: BikesService = TestBed.get(BikesService);
    expect(service).toBeTruthy();
  });
});
