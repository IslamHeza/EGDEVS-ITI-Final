import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { faSignal, faSlidersH } from '@fortawesome/free-solid-svg-icons';
import { UserService } from 'src/app/service/user.service';
import { User } from 'src/app/_models/user';

@Component({
  selector: 'app-left',
  templateUrl: './left.component.html',
  styleUrls: ['./left.component.css']
})
export class LeftComponent implements OnInit {
  faSignal=faSignal;
  faslide= faSlidersH;
  allUsers:any=[]
  user = new User;
  data:any;
  checkUser:any;

  userData: any;
  onlineUser: User = new User();

  constructor(private userService:UserService,private route:ActivatedRoute) { }
  ngOnInit(): void {
    if(this.user.type=="client"){
      this.checkUser=true;
    }else{
      this.checkUser=false;
    }
    this.onlineUser.id = localStorage.getItem('id');
  this.getUser(this.onlineUser.id);
    this.userService.getUser(this.route.snapshot.params.id).subscribe(res =>{
      this.data = res;
      this.user = this.data;
      // console.log(this.user);
    })

 }

 getUser(id: any) {
  return this.userService.getUser(id).subscribe((res) => {
    this.userData = res;
    this.onlineUser = this.userData;
    console.log(this.onlineUser.type);

  });
}
}


