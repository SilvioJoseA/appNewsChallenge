import React from 'react';
import PropTypes from 'prop-types';
import CardBody from './CardBody';
import CardImagen from './CardImagen';
import CardHeader from './CardHeader';
const CardNews = (props) => {
    return (
        <div className="card-news-component card bg-dark text-white w-100 h-100">
            {props.data ? (
                <>
                    <CardHeader title={props.data.title} setFlagNews={props.setFlagNews} />
                    <CardImagen urlToImage={props.data.urlToImage} title={props.data.title} />
                    <CardBody description={props.data.description} />
                </>
            ) : (
                <div className='card-body'>
                    <p>Error en la conexión</p>
                </div>
            )}
        </div>
    );
};
CardNews.propTypes = {
    data: PropTypes.shape({
        title: PropTypes.string.isRequired,
        urlToImage: PropTypes.string.isRequired,
        description: PropTypes.string.isRequired,
    }),
    setFlagNews: PropTypes.func.isRequired,
};
export default CardNews;
