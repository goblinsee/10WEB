/**
 * 用户部分模块测试
 */

var request = require('request');
var chai = require('chai');
var User = require('./User');
var util = require('util');
var EventProxy = require('eventproxy');

var user = new User({account:'384113872@qq.com',password:'mxd6980k9'},{remote:true});
describe('用户部分模块测试',function(){
    it('注册api',function(done){
        done();
    });
        
    it('登陆的api',function(done){
        user.done(function(err){
            if(err){
                console.error(err);
                throw Error('登陆失败');
            }   
            done();
        });
    });

    it('获取相互发过消息的用户API',function(done){
        user.getMsgUser(function(err,body){
            if(err)
                throw Error(err);
            done();
        });
    });

    it('获取与某用户的聊天信息',function(done){
        user.getMsg(function(err,body){
            if(err)
                throw Error(err);
            body = JSON.parse(body);
            done();
        });
    });

    it("根据session获取当前用户的个人信息",function(done){
        user.done(function(err,request){
            if(err)
                throw new Error(err);
            request('http://www.jyonline.cc:6070/index.php/api/User/GetUserInfoBySession',function(err,req,body){
                if(err)
                    throw new Error(err);
                try{
                    body = JSON.parse(body);
                    if(body.Flag < 0)
                        throw Error("返回信息错误");
                    done();
                }catch(e){
                    throw Error(e);
                }
            });
        });
    });

});

