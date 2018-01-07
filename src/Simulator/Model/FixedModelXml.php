<?php
declare(strict_types=1);

namespace Simulator\Model;

/**
 * Class FixedModelXml
 * @package Simulator\Model
 */
class FixedModelXml implements ModelXmlInterface
{
    /**
     * Returns the model xml as a string
     *
     * @return string
     */
    public function getAsString(): string
    {
        $model = <<<MODEL
<mujoco>
    <option timestep="0.001" viscosity="0.00002" density="1.2" gravity="0 0 -9.81"/>
    <compiler coordinate="global" angle="degree"/>
    <default>
        <geom rgba=".8 .6 .4 1"/>
        <joint limited="true"/>
    </default>
    <asset>
        <texture type="skybox" builtin="gradient" rgb1="1 1 1" rgb2=".6 .8 1" width="256" height="256"/>
    </asset>
    <worldbody>
        <geom name="reference" pos="-5 0 -21" size=".5 .5 .5" type="box" rgba="0 0 0 1"/>
        <geom name="floor" pos="0 0 -20" size="50 50 .125" rgba="0 1 0 1" type="plane" condim="3"/>
        <body name="body_0">
            <freejoint/>
            <site name="head" size="0.2 0.2 0.2" rgba="1 0 0 0.5"/>
            <geom name="geom_0" type="capsule" fromto="0.00 0.00 0.00 0.01 0.01 0.01" size="0.010000"/>
            <body name="body_1">
                <geom name="geom_1" type="capsule" fromto="0.00 0.00 0.00 0.00 1.00 0.00" size="0.100000"/>
                <geom name="geom_2" type="capsule" fromto="0.00 1.00 0.00 0.00 -1.00 0.00" size="0.100000"/>
                <body name="body_2">
                    <joint type="hinge" pos="0 -1 0" axis="0 0 1" limited="true" range="-45 45" name="motor_0"/>
                    <geom name="geom_3" type="capsule" fromto="0.00 -1.00 0.00 0.00 -4.00 0.00" size="0.100000"/>
                    <body name="body_3">
                        <joint type="hinge" pos="0 -4 0" axis="1 0 0" limited="true" range="0 90" name="motor_1"/>
                        <geom name="geom_4" type="capsule" fromto="0.00 -4.00 0.00 0.00 -7.00 0.00" size="0.100000"/>
                    </body>
                </body>
                <body name="body_4">
                    <joint type="hinge" pos="0 1 0" axis="0 0 1" limited="true" range="-45 45" name="motor_2"/>
                    <geom name="geom_5" type="capsule" fromto="0.00 1.00 0.00 0.00 4.00 0.00" size="0.100000"/>
                    <body name="body_5">
                        <joint type="hinge" pos="0 4 0" axis="1 0 0" limited="true" range="180 270" name="motor_3"/>
                        <geom name="geom_6" type="capsule" fromto="0.00 4.00 0.00 0.00 7.00 0.00" size="0.100000"/>
                    </body>
                </body>
                <geom name="geom_7" type="capsule" fromto="0.00 0.00 0.00 3.00 0.00 0.00" size="0.100000"/>
                <geom name="geom_8" type="capsule" fromto="3.00 0.00 0.00 3.00 1.00 0.00" size="0.100000"/>
                <geom name="geom_9" type="capsule" fromto="3.00 1.00 0.00 3.00 -1.00 0.00" size="0.100000"/>
                <body name="body_6">
                    <joint type="hinge" pos="3 -1 0" axis="0 0 1" limited="true" range="-45 45" name="motor_4"/>
                    <geom name="geom_10" type="capsule" fromto="3.00 -1.00 0.00 3.00 -4.00 0.00" size="0.100000"/>
                    <body name="body_7">
                        <joint type="hinge" pos="3 -4 0" axis="1 0 0" limited="true" range="0 90" name="motor_5"/>
                        <geom name="geom_11" type="capsule" fromto="3.00 -4.00 0.00 3.00 -7.00 0.00" size="0.100000"/>
                    </body>
                </body>
                <body name="body_8">
                    <joint type="hinge" pos="3 1 0" axis="0 0 1" limited="true" range="-45 45" name="motor_6"/>
                    <geom name="geom_12" type="capsule" fromto="3.00 1.00 0.00 3.00 4.00 0.00" size="0.100000"/>
                    <body name="body_9">
                        <joint type="hinge" pos="3 4 0" axis="1 0 0" limited="true" range="180 270" name="motor_7"/>
                        <geom name="geom_13" type="capsule" fromto="3.00 4.00 0.00 3.00 7.00 0.00" size="0.100000"/>
                    </body>
                </body>
                <geom name="geom_14" type="capsule" fromto="3.00 0.00 0.00 6.00 0.00 0.00" size="0.100000"/>
                <geom name="geom_15" type="capsule" fromto="6.00 0.00 0.00 6.00 1.00 0.00" size="0.100000"/>
                <geom name="geom_16" type="capsule" fromto="6.00 1.00 0.00 6.00 -1.00 0.00" size="0.100000"/>
                <body name="body_10">
                    <joint type="hinge" pos="6 -1 0" axis="0 0 1" limited="true" range="-45 45" name="motor_8"/>
                    <geom name="geom_17" type="capsule" fromto="6.00 -1.00 0.00 6.00 -4.00 0.00" size="0.100000"/>
                    <body name="body_11">
                        <joint type="hinge" pos="6 -4 0" axis="1 0 0" limited="true" range="0 90" name="motor_9"/>
                        <geom name="geom_18" type="capsule" fromto="6.00 -4.00 0.00 6.00 -7.00 0.00" size="0.100000"/>
                    </body>
                </body>
                <body name="body_12">
                    <joint type="hinge" pos="6 1 0" axis="0 0 1" limited="true" range="-45 45" name="motor_10"/>
                    <geom name="geom_19" type="capsule" fromto="6.00 1.00 0.00 6.00 4.00 0.00" size="0.100000"/>
                    <body name="body_13">
                        <joint type="hinge" pos="6 4 0" axis="1 0 0" limited="true" range="180 270" name="motor_11"/>
                        <geom name="geom_20" type="capsule" fromto="6.00 4.00 0.00 6.00 7.00 0.00" size="0.100000"/>
                    </body>
                </body>
            </body>
        </body>
    </worldbody>
    <actuator>
        <motor name="motor_0" joint="motor_0" gear="400 400 400"/>
        <motor name="motor_1" joint="motor_1" gear="400 400 400"/>
        <motor name="motor_2" joint="motor_2" gear="400 400 400"/>
        <motor name="motor_3" joint="motor_3" gear="400 400 400"/>
        <motor name="motor_4" joint="motor_4" gear="400 400 400"/>
        <motor name="motor_5" joint="motor_5" gear="400 400 400"/>
        <motor name="motor_6" joint="motor_6" gear="400 400 400"/>
        <motor name="motor_7" joint="motor_7" gear="400 400 400"/>
        <motor name="motor_8" joint="motor_8" gear="400 400 400"/>
        <motor name="motor_9" joint="motor_9" gear="400 400 400"/>
        <motor name="motor_10" joint="motor_10" gear="400 400 400"/>
        <motor name="motor_11" joint="motor_11" gear="400 400 400"/>
    </actuator>
</mujoco>
MODEL;

        return $model;
    }
}
