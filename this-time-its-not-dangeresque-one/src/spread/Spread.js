import React, { Component } from 'react';
import {SpreadContainer} from './SpreadContainer';

const desc ='', 
      imgUrl= "https://images.pexels.com/photos/104827/cat-pet-animal-domestic-104827.jpeg?auto=compress&cs=tinysrgb&h=350", 
      formattedBlog= '';

export class Spread extends Component {
  constructor(props) {
    super(props);
    this.state = {            
    }
  }


  render(){
    return (
    <div>      
      <SpreadContainer className="SpreadContainer" 
      imgUrl={this.props.imgUrl} 
      desc={this.props.desc} 
      formattedBlog={this.props.formattedBlog} />
    </div>
    );
  }
}
