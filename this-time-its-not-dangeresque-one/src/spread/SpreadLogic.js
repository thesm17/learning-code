import React, { Component } from 'react';
import glamorous from 'glamorous';
import PropTypes from 'prop-types'

const phoneOnly = '@media only screen and (max-width: 600px)',
      mediumMedia = '@media only screen and (max-width: 880px)',
      largeMedia = '@media only screen and (min-width: 801px)';

const Hero = glamorous.div({

});

const NumberOne = glamorous.div({

});

const BigSeven = glamorous.div({

});

const Entry = glamorous.div({

});

const ThumbPhoto = glamorous.img({

});

const Preview = glamorous.div({

});

const Title = glamorous.div({

});

const Byline = glamorous.div({

});

export class SpreadContainer extends Component{
  constructor(props) {
    super(props);
  }
  
  render() {
    return (
      <Container>
         <Thumbnail>
            <ThumbImg src={this.props.imgUrl}/>
            <Overlay>{this.props.desc} - {this.props.id}</Overlay>
        </Thumbnail>
        <Righty>{this.props.formattedBlog}</Righty>
      </Container>
    )
  }
}