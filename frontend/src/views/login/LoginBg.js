import { useState } from "react";
import LoginForm from "./LoginForm";
import LoginFormRegister from "./LoginFormRegister";

const LoginBg = () => {
    const [ flagNewUser , setFlagNewUser ] = useState(false);
    const [ acountText , setAcountText ] = useState('Create Acount');
    const handleAClick = () => {
        acountText!== 'Create Acount'?setAcountText('Create Acount'):setAcountText('Log In');
        setFlagNewUser(!flagNewUser)
    }
    return (
        <div className="col login-bg">
            { !flagNewUser? <LoginForm />: <LoginFormRegister handleAClick={handleAClick} /> }
            <div className="row"><div className="col-12 d-flex justify-content-center align-items-center"><a onClick={handleAClick} className="text-white">{acountText}</a></div></div>
        </div>
    );
};
export default LoginBg;