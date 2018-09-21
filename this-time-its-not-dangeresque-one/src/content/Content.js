import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { Spread } from '../spread/Spread';
import { blogs } from '../blog/Blog';

let myBlogs = blogs;

const createBlogs = myBlogs.map((index, num) =>
<Spread id={`entry${num}`} imgUrl={index.imgUrl} desc={index.desc} formattedBlog={index.formattedBlog} key={index.formattedBlog.toString()}/>
);


export class Content extends Component {
 constructor(props) {
    super(props);
    this.state = {           
    };
  }
  
  
  render() {
    return <div>{createBlogs}</div>;
    }
  }
