import React, { Component } from 'react';
import glamorous from 'glamorous';

const Container = glamorous.div({
  display: "grid",
  gridTemplateColumns: "35% 1fr 50%",
  backgroundColor: "#a3a3a3",
  height: "300px",
});


const Thumbnail = glamorous.div({
  gridColumn: "1",
  display: "grid",
  gridTemplateRows: "80% 20%",
 borderLeft: "5px solid blue",
  },
  props => ({backgroundImage: `url(${props.source})`}));

const Righty = glamorous.div({
  gridColumn: "3"
});

const Overlay = glamorous.div({
  gridRow: '2',
  maxHeight: '60px',
  gridColumn: "1",
  display: 'inline-block',
  backgroundColor: 'rgba(211,211,211,0.6)',
  paddingTop: '3px',
  borderRadius: '10px',
  marginLeft: '8px',
  marginRight: '8px',
  overflow: 'auto',
  alignSelf: 'end',
});



export class SpreadContainer extends Component{
  constructor(props) {
    super(props);
  }
  
  render() {
    return (
      <Container>
          <Thumbnail source={this.props.imgUrl}>
            <Overlay>{this.props.desc}</Overlay>
          </Thumbnail>
          <Righty dangerouslySetInnerHTML={{__html: this.props.formattedBlog}} />
      </Container>
    )
  }
}

