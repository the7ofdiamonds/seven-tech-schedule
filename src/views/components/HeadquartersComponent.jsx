import React from 'react';

function HeadquartersComponent(props) {
  const { headquarters } = props;

  return <div class="headquarters-card card">{headquarters}</div>;
}

export default HeadquartersComponent;
