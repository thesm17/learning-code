import React, { Component } from 'react';
import {SpreadContainer} from './SpreadContainer';
import PropTypes from 'prop-types';
import Blog from '../blog/Blog';

export class Spread extends Component {
  constructor(props) {
    super(props);
    this.state = {
      userInput: '',
      imgUrl: Blog.imgUrl,
      desc: Blog.desc,
      formattedBlog: Blog.formattedBlog
    }
    this.handleUserInput = this.handleUserInput.bind(this);
  }

  handleUserInput(e) {
    this.setState({
      userInput: e.target.value
    });
  }

  render(){
    return (
    <div>
      <h1>So far I've typed: {this.state.userInput}</h1>
      <input type="text" onChange={this.handleUserInput} value={this.state.userInput} />
      <SpreadContainer className="SpreadContainer"imgUrl={this.state.imgUrl} desc={this.state.desc} formattedBlog={this.state.formattedBlog} />
    </div>
    );
  }
}


Spread.propTypes = {
  imgUrl: PropTypes.string.isRequired,
  desc: PropTypes.string.isRequired,
  formattedBlog: PropTypes.object.isRequired //want to pass in a JSON object in the future, but for now will just write the file and then JSON-ify it
};

export default Spread;