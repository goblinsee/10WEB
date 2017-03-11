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

});

